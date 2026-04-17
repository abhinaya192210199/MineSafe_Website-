<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='supervisor'){
header("Location: login.php");
exit();
}

include("includes/db.php");

$result = $conn->query("
SELECT worker_name,
AVG(risk_score) as avg_risk
FROM scan_results
GROUP BY worker_name
ORDER BY avg_risk DESC
");

include("layout.php");
?>

<h3 class="fw-bold mb-4">📈 Risk Ranking</h3>

<div class="card p-3">

<table class="table table-hover text-center">

<tr>
<th>Rank</th>
<th>Worker</th>
<th>Risk</th>
<th>Status</th>
</tr>

<?php
$rank = 1;

while($row = $result->fetch_assoc()){
?>

<tr>

<td><?php echo $rank++; ?></td>

<td><?php echo $row['worker_name']; ?></td>

<td><?php echo round($row['avg_risk']); ?>%</td>

<td>
<?php
$risk = $row['avg_risk'];

if($risk < 40){
echo "<span class='badge bg-success'>Safe</span>";
}
elseif($risk < 70){
echo "<span class='badge bg-warning text-dark'>Medium</span>";
}
else{
echo "<span class='badge bg-danger'>High Risk</span>";
}
?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>
</body>
</html>