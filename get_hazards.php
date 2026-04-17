<?php
include("../includes/db.php");

$result = $conn->query("SELECT * FROM hazards ORDER BY id DESC");

$data = array();

while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>