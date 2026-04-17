<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'supervisor'){
header("Location: login.php");
exit();
}

include("includes/db.php");

$result = $conn->query("SELECT * FROM hazards ORDER BY created_at DESC");

include("layout.php");
?>

<h3 class="fw-bold mb-4">⚠ Hazard Management</h3>

<div class="card p-3">

<table class="table table-hover text-center">

<tr>
<th>Worker</th>
<th>Type</th>
<th>Description</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['worker_id']; ?></td>
<td><?php echo $row['hazard_type']; ?></td>
<td><?php echo $row['description']; ?></td>

<td>
<?php
echo $row['status']=="Resolved"
? "<span class='badge bg-success'>Resolved</span>"
: "<span class='badge bg-danger'>Pending</span>";
?>
</td>

<td>
<?php if($row['status']=="Pending"){ ?>
<a href="resolve_hazard.php?id=<?php echo $row['id']; ?>">
<button class="btn btn-success btn-sm">Resolve</button>
</a>
<?php } else { echo "Done"; } ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>
</body>
</html>