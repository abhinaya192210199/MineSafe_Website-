<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='supervisor'){
header("Location: login.php");
exit();
}

include("includes/db.php");

/* Helmet violations per day */
$helmet_data = $conn->query("
SELECT DATE(scan_time) as day, COUNT(*) as total
FROM scan_results
WHERE helmet='Missing'
GROUP BY DATE(scan_time)
ORDER BY day
");

/* Fatigue alerts per day */
$fatigue_data = $conn->query("
SELECT DATE(scan_time) as day, COUNT(*) as total
FROM scan_results
WHERE fatigue='High'
GROUP BY DATE(scan_time)
ORDER BY day
");

/* High risk scans per day */
$risk_data = $conn->query("
SELECT DATE(scan_time) as day, COUNT(*) as total
FROM scan_results
WHERE risk_score>80
GROUP BY DATE(scan_time)
ORDER BY day
");

$days=[];
$helmet=[];
$fatigue=[];
$risk=[];

while($row=$helmet_data->fetch_assoc()){
$days[]=$row['day'];
$helmet[]=$row['total'];
}

while($row=$fatigue_data->fetch_assoc()){
$fatigue[]=$row['total'];
}

while($row=$risk_data->fetch_assoc()){
$risk[]=$row['total'];
}

?>

<!DOCTYPE html>
<html>

<head>

<title>PPE Safety Trends</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body style="background:#f5efe3;">

<nav class="navbar navbar-expand-lg bg-warning shadow-sm">

<div class="container-fluid">

<span class="navbar-brand fw-bold">MineSafe AI – Analytics</span>

<div>

<a class="btn btn-light btn-sm me-2" href="supervisor_panel.php">Dashboard</a>

<a class="btn btn-light btn-sm me-2" href="hazard_management.php">Hazards</a>

<a class="btn btn-light btn-sm me-2" href="worker_risk_ranking.php">Risk Ranking</a>

<a class="btn btn-dark btn-sm" href="logout.php">Logout</a>

</div>

</div>

</nav>


<div class="container mt-4">

<h3 class="mb-4">PPE Violation Trends</h3>

<div class="card shadow-sm p-4 mb-4">

<h5 class="text-center">Helmet Violations Over Time</h5>

<canvas id="helmetChart"></canvas>

</div>

<div class="card shadow-sm p-4 mb-4">

<h5 class="text-center">Fatigue Alerts Over Time</h5>

<canvas id="fatigueChart"></canvas>

</div>

<div class="card shadow-sm p-4">

<h5 class="text-center">High Risk Scans Over Time</h5>

<canvas id="riskChart"></canvas>

</div>

</div>


<script>

const days = <?php echo json_encode($days); ?>;

const helmetData = <?php echo json_encode($helmet); ?>;

const fatigueData = <?php echo json_encode($fatigue); ?>;

const riskData = <?php echo json_encode($risk); ?>;


/* Helmet Chart */

new Chart(document.getElementById('helmetChart'),{

type:'line',

data:{
labels:days,
datasets:[{
label:'Helmet Missing',
data:helmetData,
borderColor:'red',
fill:false
}]
}

});


/* Fatigue Chart */

new Chart(document.getElementById('fatigueChart'),{

type:'line',

data:{
labels:days,
datasets:[{
label:'Fatigue Alerts',
data:fatigueData,
borderColor:'orange',
fill:false
}]
}

});


/* Risk Chart */

new Chart(document.getElementById('riskChart'),{

type:'line',

data:{
labels:days,
datasets:[{
label:'High Risk Scans',
data:riskData,
borderColor:'purple',
fill:false
}]
}

});

</script>

</body>

</html>