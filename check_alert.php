<?php
include("includes/db.php");

/* Only check last 10 seconds */

$result = $conn->query("
SELECT * FROM scan_results 
WHERE (helmet='Missing' OR fatigue='High')
AND scan_time >= NOW() - INTERVAL 10 SECOND
ORDER BY scan_time DESC LIMIT 1
");

$response = ["alert" => false];

if($result->num_rows > 0){
$response["alert"] = true;
}

echo json_encode($response);
?>