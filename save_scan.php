<?php
include("../includes/db.php");

$helmet = $_POST['helmet'];
$vest = $_POST['vest'];
$fatigue = $_POST['fatigue'];
$risk = $_POST['risk'];

$sql = "INSERT INTO scan_results (worker_name, helmet, vest, fatigue, risk_score)
VALUES ('Worker','$helmet','$vest','$fatigue','$risk')";

if($conn->query($sql)){
    echo "saved";
}else{
    echo "error";
}
?>