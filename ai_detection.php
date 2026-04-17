<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
<title>AI Safety Detection</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5efe3;">

<nav class="navbar navbar-expand-lg bg-warning shadow-sm">
<div class="container-fluid">
<span class="navbar-brand fw-bold">MineSafe AI</span>

<div>
<a class="btn btn-light btn-sm me-2" href="dashboard.php">Dashboard</a>
<a class="btn btn-light btn-sm me-2" href="scan_history.php">Scans</a>
<a class="btn btn-dark btn-sm" href="logout.php">Logout</a>
</div>
</div>
</nav>


<div class="container mt-5 text-center">

<h2>AI Safety Detection</h2>

<div class="row mt-4">

<div class="col-md-6">
<div class="card p-4 shadow-sm">
<h5>Live Camera Detection</h5>
<p>Use laptop camera for PPE detection</p>
<a href="live_detection.php" class="btn btn-warning w-100">Use Camera</a>
</div>
</div>

<div class="col-md-6">
<div class="card p-4 shadow-sm">

<h5>Upload Image Detection</h5>
<p>Upload worker image for safety analysis</p>

<form method="POST" enctype="multipart/form-data">
<input type="file" name="image" class="form-control mb-3" required>
<button type="submit" class="btn btn-warning w-100">Upload & Detect</button>
</form>

</div>
</div>

</div>


<?php

if(isset($_FILES['image']) && $_FILES['image']['error']==0){

if(!file_exists("uploads")){
mkdir("uploads",0777,true);
}

/* SAVE IMAGE */

$target="uploads/".time()."_".basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"],$target);

$image=$target;


/* RUN YOLO */

$command="py ai/detect.py \"$image\"";
exec($command);


/* WAIT FOR YOLO */

sleep(3);


/* FIND LATEST PREDICT FOLDER */

$folders = glob("ai/runs/detect/predict*");

usort($folders,function($a,$b){
return filemtime($b) - filemtime($a);
});

$latest_folder = $folders[0];


/* FIND DETECTED IMAGE */

$images = glob($latest_folder."/*.{jpg,jpeg,png}",GLOB_BRACE);

if($images){

usort($images,function($a,$b){
return filemtime($b) - filemtime($a);
});

$detected_image = $images[0]."?v=".time();


echo "<div class='mt-5'>";
echo "<h4>Detection Result</h4>";
echo "<img src='$detected_image' class='img-fluid rounded shadow' width='500'>";
echo "</div>";



/* FIND LABEL FILE */

$labels = glob($latest_folder."/labels/*.txt");

if($labels){

$data = file($labels[0]);

$classes=[];

foreach($data as $line){
$parts=explode(" ",trim($line));
$classes[]=$parts[0];
}


/* PPE STATUS */

$helmet="Missing";
$gloves="Missing";
$mask="Missing";
$suit="Missing";

foreach($classes as $c){

if($c==2) $helmet="Detected";
if($c==7) $helmet="Missing";

if($c==0) $gloves="Detected";
if($c==5) $gloves="Missing";

if($c==3) $mask="Detected";
if($c==8) $mask="Missing";

if($c==11) $suit="Detected";
if($c==4) $suit="Missing";

}


/* RESULT PANEL */

echo "<div class='card mt-4 p-3'>";
echo "<h5>Safety Equipment Detection</h5>";

echo "<p>Helmet : <b style='color:".($helmet=="Detected"?"green":"red")."'>$helmet</b></p>";
echo "<p>Gloves : <b style='color:".($gloves=="Detected"?"green":"red")."'>$gloves</b></p>";
echo "<p>Mask : <b style='color:".($mask=="Detected"?"green":"red")."'>$mask</b></p>";
echo "<p>Safety Suit : <b style='color:".($suit=="Detected"?"green":"red")."'>$suit</b></p>";

echo "</div>";

}

}else{

echo "<div class='alert alert-danger mt-4'>Detection failed.</div>";

}

}

?>

</div>

</body>
</html>