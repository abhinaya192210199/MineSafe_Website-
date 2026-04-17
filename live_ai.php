<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

include("layout.php");
?>

<h3 class="mb-4 fw-bold">🤖 AI Safety Detection</h3>

<div class="row g-4">

<!-- CAMERA -->
<div class="col-md-6">
<div class="card p-4 text-center h-100">

<h5 class="fw-bold">📷 Live Camera Detection</h5>

<p class="text-muted">Start real-time PPE detection using webcam</p>

<button class="btn btn-primary w-100 py-2 fw-bold mt-3" onclick="startCamera()">
<i class="bi bi-camera-video me-2"></i> Start Camera
</button>

</div>
</div>

<!-- UPLOAD -->
<div class="col-md-6">
<div class="card p-4 text-center h-100">

<h5 class="fw-bold">📤 Upload Image Detection</h5>

<p class="text-muted">Upload image to detect helmet, vest & fatigue</p>

<form action="detect_upload.php" method="POST" enctype="multipart/form-data">

<input type="file" name="image" class="form-control mt-3 mb-3" required>

<button class="btn btn-primary w-100 py-2 fw-bold" onclick="showLoader()">
<i class="bi bi-upload me-2"></i> Upload & Detect
</button>

</form>

</div>
</div>

</div>

<!-- LOADER -->
<div id="loader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; justify-content:center; align-items:center;">
<div class="spinner-border text-primary" style="width:3rem; height:3rem;"></div>
</div>

<script>
function startCamera(){
document.getElementById("loader").style.display = "flex";

fetch("run_ai.php")
.then(res => res.text())
.then(data => {
document.getElementById("loader").style.display = "none";
alert(data);
});
}

function showLoader(){
document.getElementById("loader").style.display = "flex";
}
</script>

</div>
</body>
</html>