<?php
$conn = new mysqli("localhost", "root", "", "mineguard");

if ($conn->connect_error) {
    die("Connection failed");
}

// ✅ Only workers
$result = $conn->query("SELECT id, Employee_id, name FROM users WHERE role='worker'");

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>