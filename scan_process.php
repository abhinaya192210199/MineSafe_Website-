<?php
include("../includes/db.php");

$worker_name = "Worker"; 

$helmet = $_POST['helmet'];
$vest = $_POST['vest'];
$fatigue = $_POST['fatigue'];
$risk_score = $_POST['risk_score'];

$sql = "INSERT INTO scan_results(worker_name,helmet,vest,fatigue,risk_score)
VALUES('$worker_name','$helmet','$vest','$fatigue','$risk_score')";

$conn->query($sql);

echo "Saved";
?>