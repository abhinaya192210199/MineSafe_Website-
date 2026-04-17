<?php
session_start();
include("includes/db.php");

$alerts = $conn->query("
SELECT * FROM scan_results
WHERE helmet='Missing' OR fatigue='High'
ORDER BY scan_time DESC
");

include("layout.php");
?>

<h3>⚠ Safety Alerts</h3>

<table class="table table-dark table-striped mt-3">

<tr>
<th>Worker</th>
<th>Helmet</th>
<th>Fatigue</th>
<th>Time</th>
</tr>

<?php while($row=$alerts->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['worker_name']; ?></td>
<td class="text-danger"><?php echo $row['helmet']; ?></td>
<td class="text-warning"><?php echo $row['fatigue']; ?></td>
<td><?php echo $row['scan_time']; ?></td>
</tr>

<?php } ?>

</table>

</div></body></html>