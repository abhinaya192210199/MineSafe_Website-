<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='supervisor'){
header("Location: login.php");
exit();
}

include("includes/db.php");

/* Get average risk score per day */

$data = $conn->query("
SELECT DATE(scan_time) as day, AVG(risk_score) as avg_risk
FROM scan_results
GROUP BY DATE(scan_time)
ORDER BY day
");

$days=[];
$risk=[];

while($row=$data->fetch_assoc()){
$days[]=$row['day'];
$risk[]=round($row['avg_risk'],2);
}

/* Simple prediction: next risk = last average + trend */

$prediction=0;

if(count($risk)>=2){
$last=$risk[count($risk)-1];
$prev=$risk[count($risk)-2];
$trend=$last-$prev;
$prediction=round($last+$trend,2);
}else{
$prediction=50;
}

$risk_level="LOW";
$color="green";

if($prediction>70){
$risk_level="HIGH";
$color="red";
}
elseif($prediction>40){
$risk_level="MEDIUM";
$color="orange";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>AI Risk Prediction</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body style="background:#f5efe3;">

<nav class="navbar navbar-expand-lg bg-warning shadow-sm">

<div class="container-fluid">

<span class="navbar-brand fw-bold">MineSafe AI – Prediction</span>

<div>

<a class="btn btn-light btn-sm me-2" href="supervisor_panel.php">Dashboard</a>

<a class="btn btn-light btn-sm me-2" href="ppe_trends.php">Safety Trends</a>

<a class="btn btn-dark btn-sm" href="logout.php">Logout</a>

</div>

</div>

</nav>


<div class="container mt-4">

<h3 class="mb-4">AI Safety Risk Prediction</h3>


<div class="card shadow-sm text-center mb-4">

<div class="card-body">

<h5>Predicted Mine Risk Level (Next Cycle)</h5>

<h2 style="color:<?php echo $color;?>">

<?php echo $risk_level;?> RISK

</h2>

<p>Predicted Risk Score: <b><?php echo $prediction;?>%</b></p>

</div>

</div>


<div class="card shadow-sm p-4">

<h5 class="text-center">Historical Risk Trend</h5>

<canvas id="riskTrend"></canvas>

</div>

</div>


<script>

const days = <?php echo json_encode($days); ?>;

const riskData = <?php echo json_encode($risk); ?>;

new Chart(document.getElementById('riskTrend'),{

type:'line',

data:{
labels:days,
datasets:[{
label:'Average Risk Score',
data:riskData,
borderColor:'red',
fill:false
}]
},

options:{
plugins:{legend:{display:true}},
scales:{y:{beginAtZero:true}}
}

});

</script>

</body>

</html>