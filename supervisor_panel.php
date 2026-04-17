<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'supervisor'){
    header("Location: login.php");
    exit();
}

include("includes/db.php");

/* =========================
   STATS
========================= */
$total_workers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];

$total_scans = $conn->query("SELECT COUNT(*) as total FROM scan_results")->fetch_assoc()['total'];

$high_risk = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE risk_score > 70")->fetch_assoc()['total'];

$alerts = $conn->query("SELECT COUNT(*) as total FROM scan_results WHERE helmet='Missing' OR fatigue='High'")->fetch_assoc()['total'];

/* =========================
   HAZARDS (FIXED)
========================= */
$hazards = $conn->query("SELECT * FROM hazards ORDER BY created_at DESC");

/* =========================
   RECENT SCANS (FIXED)
========================= */
$recent = $conn->query("SELECT * FROM scan_results ORDER BY created_at DESC LIMIT 10");

include("layout.php");
?>

<div class="container mt-4">

<h3 class="fw-bold mb-3">🧑‍💼 Supervisor Dashboard</h3>

<!-- 🔥 BUTTON -->
<div class="mb-3">
    <a href="history.php" class="btn btn-primary">
        📜 View Detection History
    </a>
</div>

<!-- 🔴 LIVE ALERT -->
<div id="liveAlert"></div>

<script>
let alertShown = false;

setInterval(() => {
fetch("check_alert.php")
.then(res => res.json())
.then(data => {

if(data.alert && !alertShown){
document.getElementById("liveAlert").innerHTML = `
<div class="alert alert-danger shadow">
⚠ LIVE ALERT: Safety violation detected!
</div>`;

alertShown = true;

setTimeout(() => {
alertShown = false;
}, 10000);
}

});
}, 5000);
</script>

<!-- 📊 STATS -->
<div class="row g-3 mb-4">

<div class="col-md-3">
<div class="card p-3 text-center shadow-sm border-0">
<h6>Total Workers</h6>
<h3><?php echo $total_workers; ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center shadow-sm border-0">
<h6>Total Scans</h6>
<h3><?php echo $total_scans; ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center shadow-sm border-0">
<h6>High Risk</h6>
<h3 class="text-danger"><?php echo $high_risk; ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center shadow-sm border-0">
<h6>Active Alerts</h6>
<h3 class="text-warning"><?php echo $alerts; ?></h3>
</div>
</div>

</div>

<!-- 🚨 HAZARD MANAGEMENT -->
<h5 class="fw-bold">⚠ Hazard Management</h5>

<div class="card p-3 mb-4 shadow-sm border-0">

<table class="table table-hover text-center">

<tr>
<th>Worker</th>
<th>Type</th>
<th>Description</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($h = $hazards->fetch_assoc()){ ?>

<tr>

<td><?php echo $h['worker_id']; ?></td>

<td><?php echo isset($h['hazard_type']) ? $h['hazard_type'] : "N/A"; ?></td>

<td><?php echo $h['description']; ?></td>

<td>
<?php
if($h['status']=="resolved"){
echo "<span class='badge bg-success'>Resolved</span>";
}else{
echo "<span class='badge bg-danger'>Pending</span>";
}
?>
</td>

<td>
<?php if($h['status']=="pending"){ ?>
<a href="resolve_hazard.php?id=<?php echo $h['id']; ?>">
<button class="btn btn-sm btn-success">Resolve</button>
</a>
<?php } else { echo "Done"; } ?>
</td>

</tr>

<?php } ?>

</table>

</div>

<!-- 📊 RECENT SCANS -->
<h5 class="fw-bold">📊 Recent Safety Scans</h5>

<div class="card p-3 shadow-sm border-0">

<table class="table table-hover text-center">

<tr>
<th>Worker</th>
<th>Helmet</th>
<th>Fatigue</th>
<th>Risk</th>
<th>Time</th>
</tr>

<?php while($r = $recent->fetch_assoc()){ ?>

<tr>

<td><?php echo $r['worker_name']; ?></td>

<td>
<?php
echo $r['helmet']=="Missing"
? "<span class='badge bg-danger'>Missing</span>"
: "<span class='badge bg-success'>OK</span>";
?>
</td>

<td>
<?php
echo $r['fatigue']=="High"
? "<span class='badge bg-warning text-dark'>High</span>"
: "Normal";
?>
</td>

<td>
<span class="badge bg-dark">
<?php echo $r['risk_score']; ?>%
</span>
</td>

<td><?php echo $r['created_at']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>