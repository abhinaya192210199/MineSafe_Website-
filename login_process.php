<?php
session_start();
include("../includes/db.php");

// ✅ Get values safely
$employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// ✅ Basic validation
if($employee_id == "" || $password == ""){
    echo "Please enter all fields";
    exit();
}

// ✅ Query
$sql = "SELECT * FROM users WHERE Employee_id='$employee_id' AND password='$password'";
$result = $conn->query($sql);

if($result && $result->num_rows > 0){

    $user = $result->fetch_assoc();

    $_SESSION['user_id'] = $user['Employee_id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['role'] = $user['role'];

    // ✅ Redirect
    if($user['role'] == "supervisor"){
        header("Location: ../supervisor_panel.php");
    } else {
        header("Location: ../dashboard.php");
    }
    exit();

} else {
    echo "Invalid login";
}
?>