<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("includes/db.php");

/* ✅ Get latest safety */
$result = $conn->query("SELECT safety FROM ai_detections ORDER BY created_at DESC LIMIT 1");

$risk = 0;

if($result && $result->num_rows > 0){
    $row = $result->fetch_assoc();

    // Convert SAFE / UNSAFE to percentage
    if($row['safety'] == "SAFE"){
        $risk = 20;
    } else {
        $risk = 90;
    }
}

/* ✅ Helmet Alerts (detect no_helmet) */
$helmet_alert = $conn->query("
    SELECT COUNT(*) as total 
    FROM ai_detections 
    WHERE detections LIKE '%no_helmet%'
")->fetch_assoc()['total'];

/* ✅ Fatigue Alerts (you can customize later) */
$fatigue_alert = $conn->query("
    SELECT COUNT(*) as total 
    FROM ai_detections 
    WHERE detections LIKE '%fatigue%'
")->fetch_assoc()['total'];

include("layout.php");
?>

<div class="container mt-4">

<h3 class="mb-4 fw-bold">👷 Welcome <?php echo $_SESSION['name']; ?></h3>

<a href="history.php" class="btn btn-primary mb-4">
    📜 View Detection History
</a>

<div class="row">

    <!-- Risk Status -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Current Risk</h6>

            <?php
            if($risk < 40){
                echo "<span class='badge bg-success'>SAFE</span>";
            }
            elseif($risk < 70){
                echo "<span class='badge bg-warning text-dark'>MEDIUM</span>";
            }
            else{
                echo "<span class='badge bg-danger'>HIGH</span>";
            }
            ?>

        </div>
    </div>

    <!-- Helmet Alerts -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Helmet Alerts</h6>
            <h3><?php echo $helmet_alert; ?></h3>
        </div>
    </div>

    <!-- Fatigue Alerts -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Fatigue Alerts</h6>
            <h3><?php echo $fatigue_alert; ?></h3>
        </div>
    </div>

</div>

<!-- Risk Meter -->
<div class="card mt-4 p-3 shadow-sm">

    <h5>Risk Meter</h5>

    <div class="progress">

        <div class="progress-bar bg-danger"
             style="width:<?php echo $risk;?>%">
            <?php echo $risk;?>%
        </div>

    </div>

</div>

</div>

</body>
</html>