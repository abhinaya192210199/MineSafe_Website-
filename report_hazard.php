<?php
session_start();
include("../includes/db.php");

// ✅ HANDLE BOTH APP + WEBSITE

// Worker
if (isset($_SESSION['name'])) {
    $worker = $_SESSION['name']; // website
} else {
    $worker = $_POST['worker_id'] ?? ''; // app
}

// Data
$hazard = $_POST['hazard_type'] ?? '';
$description = $_POST['description'] ?? '';

// 🔴 VALIDATION
if ($worker == "" || $hazard == "" || $description == "") {
    echo "missing";
    exit();
}

// ✅ INSERT (MATCH YOUR DB)
$sql = "INSERT INTO hazards (worker_id, hazard_type, description, status)
VALUES ('$worker', '$hazard', '$description', 'Pending')";

if ($conn->query($sql)) {

    // ✅ WEBSITE REDIRECT
    if (isset($_SESSION['name'])) {
        header("Location: ../dashboard.php");
    } else {
        echo "success"; // app response
    }

} else {
    echo "error";
}
?>