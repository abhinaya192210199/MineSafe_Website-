<?php
$conn = new mysqli("localhost", "root", "", "mineguard");

$id = $_GET['worker_id'];

$result = $conn->query("SELECT fatigue, ppe FROM users WHERE Employee_id='$id'");
$row = $result->fetch_assoc();

echo json_encode($row);
?>