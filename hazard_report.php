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

<title>Report Hazard</title>

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
max-width:500px;
margin:auto;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

input,select,textarea{
width:100%;
padding:10px;
margin-top:10px;
margin-bottom:15px;
border-radius:8px;
border:1px solid #ccc;
}

button{
background:#d9c7a3;
border:none;
padding:12px;
width:100%;
border-radius:10px;
cursor:pointer;
}

button:hover{
background:#cbb68e;
}

</style>

</head>

<body>

<div class="container">

<h2>Report Hazard</h2>

<form action="api/report_hazard.php" method="POST">

<label>Hazard Type</label>

<select name="hazard_type" required>
<option value="">Select</option>
<option>Gas Leak</option>
<option>Rock Fall</option>
<option>Equipment Damage</option>
<option>Unsafe Area</option>
</select>

<label>Location</label>

<input type="text" name="location" placeholder="Tunnel / Area">

<label>Description</label>

<textarea name="description" placeholder="Describe the hazard"></textarea>

<button type="submit">Submit Report</button>

</form>

</div>

</body>
</html>