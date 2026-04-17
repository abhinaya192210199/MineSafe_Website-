<?php
include("../includes/db.php");

$worker_id = $_POST['worker_id'];
$status = $_POST['status'];

$sql = "INSERT INTO checklist (worker_id, status) VALUES ('$worker_id', '$status')";

if($conn->query($sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}
?>