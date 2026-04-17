<?php
include("../includes/db.php");

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM app_users WHERE id='$id'");
$row = $result->fetch_assoc();

echo json_encode($row);
?>