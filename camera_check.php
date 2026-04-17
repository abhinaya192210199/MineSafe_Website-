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

<title>Safety Scan</title>

<style>

body{
font-family:Arial;
background:#f5efe3;
padding:40px;
text-align:center;
}

.container{
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
max-width:500px;
margin:auto;
}

button{
margin-top:20px;
padding:12px 20px;
background:#d9c7a3;
border:none;
border-radius:10px;
font-size:16px;
cursor:pointer;
}

input{
margin-top:20px;
}

</style>

</head>

<body>

<div class="container">

<h2>Safety Scan</h2>

<p>Upload your image for PPE and fatigue detection.</p>

<form action="ai/analyze_image.php" method="POST" enctype="multipart/form-data">

<input type="file" name="image" required>

<br>

<button type="submit">Run Safety Scan</button>

</form>

</div>

</body>
</html>