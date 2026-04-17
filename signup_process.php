<?php

include("../config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST['name'];
$employee_id = $_POST['employee_id'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$password = $_POST['password'];

/* insert into database */
$conn->query("INSERT INTO users(name,employee_id,email,phone,department,password) 
VALUES('$name','$employee_id','$email','$phone','$department','$password')");

/* 🔥 REDIRECT TO LOGIN */
header("Location: ../login.php?success=1");
exit();

}
?>