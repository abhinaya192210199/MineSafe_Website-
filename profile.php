<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Worker Profile</title>

<style>

body{
font-family:Arial;
background:#f5efe3;
padding:40px;
}

.container{
max-width:500px;
margin:auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="container">

<h2>Worker Profile</h2>

<p><b>Name:</b> <?php echo $_SESSION['name']; ?></p>

<p><b>User ID:</b> <?php echo $_SESSION['user_id']; ?></p>

</div>

</body>
</html>