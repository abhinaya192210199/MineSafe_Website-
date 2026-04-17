<?php
$conn = new mysqli("localhost", "root", "", "mineguard");

$total = $conn->query("SELECT COUNT(*) as c FROM hazards")->fetch_assoc();
$pending = $conn->query("SELECT COUNT(*) as c FROM hazards WHERE status='Pending'")->fetch_assoc();
$resolved = $conn->query("SELECT COUNT(*) as c FROM hazards WHERE status='Resolved'")->fetch_assoc();

echo json_encode([
    "total" => $total['c'],
    "pending" => $pending['c'],
    "resolved" => $resolved['c']
]);
?>