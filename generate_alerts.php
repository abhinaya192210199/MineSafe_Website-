<?php
$conn = new mysqli("localhost", "root", "", "mineguard");

$result = $conn->query("SELECT * FROM users");

while ($row = $result->fetch_assoc()) {

    $id = $row['Employee_id'];
    $fatigue = $row['fatigue'];
    $ppe = $row['ppe'];

    // 🔥 FATIGUE ALERT
    if ($fatigue > 80) {
        $conn->query("INSERT INTO hazards (worker_id, hazard_type, description, status)
        VALUES ('$id', 'Fatigue Alert', 'Worker fatigue too high', 'Pending')");
    }

    // 🔥 PPE ALERT
    if ($ppe < 70) {
        $conn->query("INSERT INTO hazards (worker_id, hazard_type, description, status)
        VALUES ('$id', 'PPE Violation', 'Low PPE compliance', 'Pending')");
    }
}

echo "done";
?>