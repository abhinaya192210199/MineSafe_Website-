<?php
$conn = new mysqli("localhost", "root", "", "mineguard");

$id = $_POST['id'];
$status = $_POST['status'];

$conn->query("UPDATE hazards SET status='$status' WHERE id='$id'");

echo "success";
?>