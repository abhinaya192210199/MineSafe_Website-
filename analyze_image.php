<?php

include("../includes/db.php");

if(isset($_FILES['image'])){

$filename = basename($_FILES['image']['name']);
$target = "../uploads/".$filename;

move_uploaded_file($_FILES['image']['tmp_name'],$target);

$api_url = "http://127.0.0.1:5000/analyze";

$response = file_get_contents($api_url);

$result = json_decode($response,true);

$helmet = $result['helmet'];
$vest = $result['vest'];
$fatigue = $result['fatigue'];
$risk = $result['risk_score'];

$sql = "INSERT INTO scan_results (worker_name, helmet, vest, fatigue, risk_score)
VALUES ('Worker','$helmet','$vest','$fatigue','$risk')";

$conn->query($sql);

echo "<h2>Safety Scan Result</h2>";

echo "<img src='../uploads/".$filename."' width='300'><br><br>";

echo "<b>Helmet:</b> ".$helmet."<br>";
echo "<b>Vest:</b> ".$vest."<br>";
echo "<b>Fatigue Level:</b> ".$fatigue."<br>";
echo "<b>Risk Score:</b> ".$risk."%";

}
?>