<?php
include("../includes/db.php");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

$conn->query("UPDATE app_users SET name='$name', email='$email' WHERE id='$id'");

echo json_encode(["status"=>"success"]);
?>