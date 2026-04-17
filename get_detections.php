<?php
include("../includes/db.php");

$result = $conn->query("SELECT * FROM ai_detections ORDER BY id DESC");

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>