<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("includes/db.php");

/* ✅ Use correct table */
$result = $conn->query("SELECT * FROM ai_detections ORDER BY created_at DESC LIMIT 1");

include("layout.php");
?>

<h3 class="fw-bold mb-4">😴 Fatigue Monitoring</h3>

<div class="card p-4 text-center">

<?php

if($result && $result->num_rows > 0){

    $row = $result->fetch_assoc();

    // ✅ Correct columns
    $worker = $row['employee_id'];
    $detections = $row['detections'];
    $time = $row['created_at'];

    echo "<p><b>Worker:</b> $worker</p>";
    echo "<p><b>Time:</b> $time</p>";

    // ✅ Simulated fatigue logic
    if(strpos($detections, "fatigue") !== false){
        echo "<span class='badge bg-danger fs-5'>🔴 HIGH FATIGUE</span>";
    }
    else{
        echo "<span class='badge bg-success fs-5'>🟢 NORMAL</span>";
    }

}else{
    echo "<p>No fatigue data available</p>";
}

?>

</div>

</div>
</body>
</html>