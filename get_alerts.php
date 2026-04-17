<?php
$conn = new mysqli("localhost", "root", "", "mineguard");

$result = $conn->query("SELECT * FROM hazards");

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>