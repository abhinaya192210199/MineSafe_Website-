<?php
?>

<!DOCTYPE html>
<html>
<head>
<title>MineSafe AI</title>

<style>

body{
margin:0;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
font-family:'Segoe UI', sans-serif;
background:#f8fafc;
overflow:hidden;
transition:opacity 0.6s ease;
}

/* 🔥 SOFT BACKGROUND GLOW */
.background-glow{
position:absolute;
width:600px;
height:600px;
background: radial-gradient(circle, rgba(79,70,229,0.12), transparent 70%);
top:50%;
left:50%;
transform:translate(-50%, -50%);
filter:blur(80px);
}

/* GLASS CARD */
.container{
position:relative;
z-index:2;
text-align:center;
padding:50px 60px;
border-radius:18px;
background:rgba(255,255,255,0.7);
backdrop-filter:blur(20px);
box-shadow:0 10px 40px rgba(0,0,0,0.08);
animation:fadeUp 1s ease;
}

/* LOGO */
.logo img{
width:80px;
opacity:0;
animation:fadeIn 1.2s ease forwards;
}

/* TITLE */
.title{
font-size:28px;
font-weight:600;
margin-top:15px;
color:#1f2937;
opacity:0;
animation:fadeIn 1.6s ease forwards;
}

/* TAGLINE (typing effect) */
.tagline{
font-size:14px;
color:#6b7280;
margin-top:8px;
white-space:nowrap;
overflow:hidden;
border-right:2px solid #4f46e5;
width:0;
animation:typing 2s steps(40,end) forwards, blink 0.7s infinite;
}

/* PROGRESS BAR */
.progress{
margin-top:25px;
width:220px;
height:4px;
background:#e5e7eb;
border-radius:10px;
overflow:hidden;
}

.progress span{
display:block;
height:100%;
width:0%;
background:#4f46e5;
animation:loadBar 3s ease forwards;
}

/* ANIMATIONS */
@keyframes fadeUp{
0%{opacity:0; transform:translateY(20px);}
100%{opacity:1; transform:translateY(0);}
}

@keyframes fadeIn{
to{opacity:1;}
}

@keyframes typing{
from{width:0}
to{width:240px}
}

@keyframes blink{
50%{border-color:transparent;}
}

@keyframes loadBar{
0%{width:0%;}
100%{width:100%;}
}

</style>

</head>

<body>

<div class="background-glow"></div>

<div class="container">

<div class="logo">
<img src="assets/logo.png" alt="MineSafe Logo">
</div>

<div class="title">MineSafe AI</div>

<div class="tagline">
AI-Powered Mine Worker Safety System
</div>

<div class="progress">
<span></span>
</div>

</div>

<script>

/* 🔥 SMOOTH REDIRECT WITH FADE OUT */
setTimeout(() => {
    document.body.style.opacity = "0";
    setTimeout(() => {
        window.location.href = "login.php";
    }, 600);
}, 4000);

</script>

</body>
</html>