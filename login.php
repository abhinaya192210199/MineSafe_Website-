<!DOCTYPE html>
<html>
<head>
<title>Login</title>

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

<h4 class="text-center mb-3 fw-bold">⛑ MineSafe AI</h4>
<p class="text-center text-muted">Login to your account</p>

<form action="api/login_process.php" method="POST">

<!-- ✅ Employee ID -->
<input type="text" name="employee_id" class="form-control mb-3" placeholder="Employee ID (EMP001)" required>

<!-- ✅ Password -->
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-primary w-100 fw-bold">Login</button>

</form>

</div>
</div>

</body>
</html>