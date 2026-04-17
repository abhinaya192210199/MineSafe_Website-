<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

include("includes/db.php");

$total_scans = $conn->query("SELECT COUNT(*) as total FROM scan_results")->fetch_assoc()['total'];

$helmet_missing = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE helmet='Missing'")->fetch_assoc()['total'];

$fatigue_alerts = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE fatigue='High'")->fetch_assoc()['total'];

$high_risk = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE risk_score > 80")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>
<head>

<title>Risk Analytics</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
font-family:Arial;
background:#f5efe3;
padding:40px;
}

.container{
max-width:1000px;
margin:auto;
}

.cards{
display:flex;
gap:20px;
margin-bottom:30px;
}

.card{
flex:1;
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
text-align:center;
font-size:18px;
}

.chart-box{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
margin-top:20px;
}

canvas{
max-width:500px;
margin:auto;
display:block;
}

.back{
margin-top:30px;
display:block;
text-align:center;
text-decoration:none;
color:black;
}

</style>

</head>

<body>

<div class="container">

<h2>Mine Safety Risk Analytics</h2>

<div class="cards">

<div class="card">
Total Scans<br><b><?php echo $total_scans; ?></b>
</div>

<div class="card">
Helmet Violations<br><b><?php echo $helmet_missing; ?></b>
</div>

<div class="card">
Fatigue Alerts<br><b><?php echo $fatigue_alerts; ?></b>
</div>

<div class="card">
High Risk Workers<br><b><?php echo $high_risk; ?></b>
</div>

</div>

<div class="chart-box">

<h3>Safety Risk Distribution</h3>

<canvas id="riskChart"></canvas>

</div>

<a href="dashboard.php" class="back">⬅ Back to Dashboard</a>

</div>

<script>

const ctx = document.getElementById('riskChart');

new Chart(ctx, {

type:'bar',

data:{
labels:['Helmet Violations','Fatigue Alerts','High Risk'],

datasets:[{
label:'Safety Issues',
data:[
<?php echo $helmet_missing ?>,
<?php echo $fatigue_alerts ?>,
<?php echo $high_risk ?>
],
backgroundColor:[
'#ff4d4d',
'#ffa500',
'#8b0000'
]
}]
},

options:{
responsive:true,
scales:{
y:{
beginAtZero:true,
ticks:{
stepSize:1
}
}
}
}

});

</script>

</body>
</html>