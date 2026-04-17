<!DOCTYPE html>
<html>
<head>
<title>Create Account</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
font-family:'Segoe UI', sans-serif;
background:#f8fafc;
}

/* SOFT BACKGROUND GLOW */
body::before{
content:'';
position:absolute;
width:500px;
height:500px;
background: radial-gradient(circle, rgba(79,70,229,0.12), transparent 70%);
top:50%;
left:50%;
transform:translate(-50%, -50%);
filter:blur(80px);
}

/* CARD */
.card{
width:380px;
padding:30px;
border-radius:18px;
background:rgba(255,255,255,0.7);
backdrop-filter:blur(20px);
box-shadow:0 10px 40px rgba(0,0,0,0.08);
z-index:2;
animation:fadeUp 0.8s ease;
}

/* TITLE */
.title{
font-size:22px;
font-weight:600;
margin-bottom:5px;
text-align:center;
}

.subtitle{
font-size:13px;
color:#6b7280;
text-align:center;
margin-bottom:20px;
}

/* INPUTS */
input{
border-radius:10px !important;
padding:10px;
}

/* BUTTON */
.btn-primary{
border-radius:10px;
font-weight:500;
}

/* LINK */
a{
text-decoration:none;
font-size:14px;
}

a:hover{
text-decoration:underline;
}

/* ANIMATION */
@keyframes fadeUp{
0%{opacity:0; transform:translateY(20px);}
100%{opacity:1; transform:translateY(0);}
}

</style>

</head>

<body>

<div class="card">

<div class="title">Create Account</div>
<div class="subtitle">Join MineSafe AI System</div>

<form action="api/signup_process.php" method="POST">

<input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>

<input type="text" name="employee_id" class="form-control mb-2" placeholder="Employee ID" required>

<input type="email" name="email" class="form-control mb-2" placeholder="Email Address" required>

<input type="text" name="phone" class="form-control mb-2" placeholder="Phone Number">

<input type="text" name="department" class="form-control mb-2" placeholder="Department">

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-primary w-100">Create Account</button>

</form>

<div class="text-center mt-3">
Already have an account? 
<a href="login.php"><b>Login</b></a>
</div>

</div>

</body>
</html>