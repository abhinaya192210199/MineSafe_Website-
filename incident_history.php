<?php

include("includes/db.php");

$incidents = $conn->query("SELECT * FROM hazards ORDER BY report_time DESC");

?>

<h2>Incident History</h2>

<table border="1">

<tr>
<th>Worker</th>
<th>Hazard</th>
<th>Description</th>
<th>Status</th>
<th>Time</th>
</tr>

<?php while($i = $incidents->fetch_assoc()){ ?>

<tr>

<td><?php echo $i['worker_name']; ?></td>
<td><?php echo $i['hazard_type']; ?></td>
<td><?php echo $i['description']; ?></td>
<td><?php echo $i['status']; ?></td>
<td><?php echo $i['report_time']; ?></td>

</tr>

<?php } ?>

</table>