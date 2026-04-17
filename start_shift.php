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

<title>Start Shift</title>

<style>

body{
font-family:Arial;
background:#f5efe3;
padding:40px;
}

.container{
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
max-width:500px;
margin:auto;
text-align:center;
}

button{
padding:15px 25px;
background:#d9c7a3;
border:none;
border-radius:10px;
font-size:16px;
cursor:pointer;
}

button:hover{
background:#cbb68e;
}

</style>

</head>

<body>

<div class="container">

<h2>Start Work Shift</h2>

<p>Before beginning work, complete the safety check.</p>

<br>

<a href="camera_check.php">
<button>Start Safety Scan</button>
</a>

</div>

</body>

</html>