<?php
include("includes/db.php");

$total_scans = $conn->query("SELECT COUNT(*) as total FROM scan_results")->fetch_assoc()['total'];

$helmet_missing = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE helmet='Missing'")->fetch_assoc()['total'];

$fatigue_alerts = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE fatigue='High'")->fetch_assoc()['total'];

$high_risk = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE risk_score > 80")->fetch_assoc()['total'];

$result = $conn->query("SELECT * FROM scan_results ORDER BY scan_time DESC LIMIT 10");

/* Predictive Risk Ranking */
$worker_risk = $conn->query("
SELECT worker_name,
AVG(risk_score) as avg_risk,
COUNT(*) as scans
FROM scan_results
GROUP BY worker_name
ORDER BY avg_risk DESC
LIMIT 5
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Supervisor Dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
font-family:Arial;
background:#f5efe3;
padding:40px;
}

.container{
max-width:1100px;
margin:auto;
}

.cards{
display:flex;
gap:20px;
margin-bottom:40px;
}

.card{
flex:1;
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
text-align:center;
}

.chart-box{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
margin-bottom:40px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
border-radius:10px;
overflow:hidden;
margin-bottom:40px;
}

th,td{
padding:12px;
border-bottom:1px solid #eee;
text-align:center;
}

th{
background:#d9c7a3;
}

.status-safe{
color:green;
font-weight:bold;
}

.status-moderate{
color:#f4b400;
font-weight:bold;
}

.status-risk{
color:red;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>Supervisor Safety Dashboard</h2>

<div class="cards">

<div class="card">
<h3>Total Scans</h3>
<?php echo $total_scans; ?>
</div>

<div class="card">
<h3>Helmet Violations</h3>
<?php echo $helmet_missing; ?>
</div>

<div class="card">
<h3>Fatigue Alerts</h3>
<?php echo $fatigue_alerts; ?>
</div>

<div class="card">
<h3>High Risk Workers</h3>
<?php echo $high_risk; ?>
</div>

</div>

<div class="chart-box">
<canvas id="helmetChart"></canvas>
</div>

<div class="chart-box">
<canvas id="fatigueChart"></canvas>
</div>

<h3>Recent Safety Scans</h3>

<table>

<tr>
<th>Worker</th>
<th>Helmet</th>
<th>Vest</th>
<th>Fatigue</th>
<th>Risk</th>
<th>Time</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['worker_name']; ?></td>
<td><?php echo $row['helmet']; ?></td>
<td><?php echo $row['vest']; ?></td>
<td><?php echo $row['fatigue']; ?></td>
<td><?php echo $row['risk_score']; ?>%</td>
<td><?php echo $row['scan_time']; ?></td>
</tr>

<?php } ?>

</table>


<h3>Worker Risk Ranking (Predictive Analytics)</h3>

<table>

<tr>
<th>Worker</th>
<th>Average Risk</th>
<th>Total Scans</th>
<th>Status</th>
</tr>

<?php while($row = $worker_risk->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['worker_name']; ?></td>

<td><?php echo round($row['avg_risk']); ?>%</td>

<td><?php echo $row['scans']; ?></td>

<td>

<?php

if($row['avg_risk'] > 80){
echo "<span class='status-risk'>🔴 High Risk</span>";
}
elseif($row['avg_risk'] > 60){
echo "<span class='status-moderate'>🟡 Moderate</span>";
}
else{
echo "<span class='status-safe'>🟢 Safe</span>";
}

?>

</td>

</tr>

<?php } ?>

</table>

</div>

<script>

const helmetChart = new Chart(document.getElementById('helmetChart'), {
type: 'pie',
data: {
labels: ['Helmet Missing','Helmet Detected'],
datasets: [{
data: [<?php echo $helmet_missing ?>, <?php echo $total_scans - $helmet_missing ?>],
backgroundColor: ['#ff6b6b','#4caf50']
}]
}
});

const fatigueChart = new Chart(document.getElementById('fatigueChart'), {
type: 'bar',
data: {
labels: ['Fatigue Alerts','Normal'],
datasets: [{
data: [<?php echo $fatigue_alerts ?>, <?php echo $total_scans - $fatigue_alerts ?>],
backgroundColor: ['#ff9800','#2196f3']
}]
}
});

</script>

</body>
</html>