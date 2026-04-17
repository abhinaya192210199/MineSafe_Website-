<?php
include("includes/db.php");

$message = "";

if(isset($_POST['reset'])){

$email = $_POST['email'];
$new_password = $_POST['new_password'];

/* check if user exists */
$result = $conn->query("SELECT * FROM users WHERE email='$email'");

if($result->num_rows > 0){

$conn->query("UPDATE users SET password='$new_password' WHERE email='$email'");

$message = "Password updated successfully!";

}else{
$message = "Email not found!";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background: linear-gradient(135deg, #eef2ff, #f8fafc);
font-family: 'Segoe UI', sans-serif;
}

.card{
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}
</style>

</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width:360px;">

<h4 class="text-center mb-3 fw-bold">🔐 Reset Password</h4>

<?php if($message != ""){ ?>
<div class="alert alert-info"><?php echo $message; ?></div>
<?php } ?>

<form method="POST">

<input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>

<input type="password" name="new_password" class="form-control mb-3" placeholder="New Password" required>

<button name="reset" class="btn btn-primary w-100 fw-bold">
Reset Password
</button>

</form>

<div class="text-center mt-3">
<a href="login.php">Back to Login</a>
</div>

</div>

</div>

</body>
</html>