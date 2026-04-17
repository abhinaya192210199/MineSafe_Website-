<?php
$conn = new mysqli("localhost", "root", "", "mineguard");

if ($conn->connect_error) {
    die("Connection failed");
}

// ✅ CHECK IF DATA EXISTS
if (!isset($_POST['Employee_id']) || !isset($_POST['password'])) {
    echo "No data received";
    exit();
}

$emp = $_POST['Employee_id'];
$pass = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE Employee_id='$emp' AND password='$pass'");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "failed";
}
?>