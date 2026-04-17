<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "includes/db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>MineGuard - History</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fa;
        }

        .title {
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .safe {
            color: green;
            font-weight: bold;
        }

        .unsafe {
            color: red;
            font-weight: bold;
        }

        table {
            border-radius: 10px;
            overflow: hidden;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .btn-back {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2 class="title">🛡 MineGuard AI - Detection History</h2>

    <a href="dashboard.php" class="btn btn-dark btn-back">⬅ Back to Dashboard</a>

    <div class="card p-3">

        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Detections</th>
                    <th>Safety</th>
                    <th>Time</th>
                </tr>
            </thead>

            <tbody>

<?php

$result = $conn->query("SELECT * FROM ai_detections ORDER BY id DESC");

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        $class = ($row['safety'] == "SAFE") ? "safe" : "unsafe";

        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['employee_id']}</td>
            <td>{$row['detections']}</td>
            <td class='$class'>{$row['safety']}</td>
            <td>{$row['created_at']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
}

?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>