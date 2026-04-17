<?php
include("../includes/db.php");

/* IMAGE CHECK */
if(!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0){
    echo json_encode(["status"=>"error","message"=>"Image upload failed"]);
    exit;
}

/* UPLOAD */
if(!file_exists("../uploads")){
    mkdir("../uploads",0777,true);
}

$target = "../uploads/" . time() . "_" . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target);

$image = realpath($target);

/* SEND TO FLASK */
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "http://10.237.143.26:5000/detect",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_TIMEOUT => 20,
    CURLOPT_POSTFIELDS => [
        "image" => new CURLFile($image),
        "employee_id" => "EMP001"
    ]
]);

$response = curl_exec($curl);

if(curl_errno($curl)){
    echo json_encode(["status"=>"error","message"=>curl_error($curl)]);
    exit;
}

curl_close($curl);

$result = json_decode($response, true);

/* RETURN JSON FOR APP */
echo json_encode([
    "status" => "success",
    "detections" => $result["detections"] ?? [],
    "safety" => $result["safety"] ?? "UNKNOWN",
    "image" => $result["image"] ?? ""
]);