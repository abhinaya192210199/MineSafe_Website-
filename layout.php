<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$role = $_SESSION['role'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>
<title>MineSafe AI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:'Segoe UI',sans-serif;
background:#f4f6fb;
}

/* Sidebar */
.sidebar{
width:230px;
height:100vh;
position:fixed;
background:#ffffff;
padding:20px;
box-shadow:0 0 15px rgba(0,0,0,0.08);
}

.sidebar h4{
font-weight:bold;
margin-bottom:30px;
}

.sidebar a{
display:block;
padding:10px;
margin-bottom:10px;
text-decoration:none;
color:#333;
border-radius:8px;
transition:0.3s;
}

.sidebar a:hover{
background:#e9efff;
}

/* Content */
.content{
margin-left:250px;
padding:30px;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.user{
background:#e9efff;
padding:8px 15px;
border-radius:20px;
font-size:14px;
}

.card{
border-radius:15px;
box-shadow:0 8px 20px rgba(0,0,0,0.05);
border:none;
}

.btn{
border-radius:10px;
}

</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

<h4>🛡 MineSafe</h4>

<a href="dashboard.php">🏠 Dashboard</a>

<?php if($role == 'worker'){ ?>

<!-- 👷 WORKER MENU -->
<a href="live_ai.php">🤖 AI Detection</a>
<a href="fatigue_monitor.php">😴 Fatigue</a>
<a href="report_hazard.php">⚠ Report Hazard</a>
<a href="scan_history.php">📊 History</a>

<?php } ?>

<?php if($role == 'supervisor'){ ?>

<!-- 🧑‍💼 SUPERVISOR MENU -->
<a href="supervisor_panel.php">📊 Monitor Panel</a>
<a href="hazard_management.php">⚠ Hazards</a>
<a href="alerts_management.php">🚨 Alerts</a>
<a href="worker_monitor.php">👷 Workers</a>
<a href="worker_risk_ranking.php">📈 Risk Ranking</a>

<?php } ?>

<a href="logout.php">🚪 Logout</a>

</div>

<!-- CONTENT -->
<div class="content">

<div class="topbar">
<h4>Welcome, <?php echo $name; ?> 👋</h4>
<div class="user"><?php echo strtoupper($role); ?></div>
</div>