<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

include("includes/db.php");

// ✅ FIXED TABLE
$result = $conn->query("SELECT * FROM scan_results ORDER BY created_at DESC");

include("layout.php");
?>

<h3 class="fw-bold mb-4">📊 Safety Scan History</h3>

<div class="card p-4">

<table class="table table-hover text-center">

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

<td>
<?php
echo $row['helmet']=="Missing" 
? "<span class='badge bg-danger'>Missing</span>" 
: "<span class='badge bg-success'>OK</span>";
?>
</td>

<td><?php echo $row['vest']; ?></td>

<td>
<?php
echo $row['fatigue']=="High"
? "<span class='badge bg-warning text-dark'>High</span>"
: "<span class='badge bg-secondary'>Normal</span>";
?>
</td>

<td>
<span class="badge bg-dark">
<?php echo $row['risk_score']; ?>%
</span>
</td>

<td><?php echo $row['scan_time']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>
</body>
</html>