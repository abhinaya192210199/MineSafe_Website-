<?php
session_start();
include("includes/db.php");

/* =========================
   UPLOAD IMAGE
========================= */
$target = "uploads/" . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target);

$image = $target;

/* =========================
   SEND TO FLASK
========================= */
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "http://127.0.0.1:5000/detect",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        // 🔥 VERY IMPORTANT FIX
        "image" => new CURLFile(realpath($image)),
        "employee_id" => $_SESSION['user_id']
    ]
]);

$response = curl_exec($curl);
curl_close($curl);

/* =========================
   DEBUG (REMOVE AFTER TEST)
========================= */
// echo "<pre>";
// print_r($response);
// exit();

$result = json_decode($response, true);

/* =========================
   DEFAULT VALUES
========================= */
$worker = $_SESSION['name'];

$helmet = "OK";
$vest = "OK";
$fatigue = "Low";
$risk = 20;

/* =========================
   PROCESS AI RESULTS
========================= */
if(isset($result["detections"])){

    foreach($result["detections"] as $obj){

        if($obj == "NO-Hardhat"){
            $helmet = "Missing";
            $risk += 30;
        }

        if($obj == "NO-Safety Vest"){
            $vest = "Missing";
            $risk += 30;
        }

        if($obj == "Fatigue"){
            $fatigue = "High";
            $risk += 40;
        }
    }
}

/* =========================
   SAVE TO DATABASE
========================= */
$conn->query("
INSERT INTO scan_results(worker_name, helmet, vest, fatigue, risk_score)
VALUES('$worker', '$helmet', '$vest', '$fatigue', $risk)
");

include("layout.php");
?>

<h3 class="fw-bold mb-4">🔍 Detection Result</h3>

<div class="alert alert-success">
✅ Detection completed & saved!
</div>

<div class="card p-4 text-center">

<?php
if(isset($result["detections"])){

    foreach($result["detections"] as $object){
        echo "<span class='badge bg-primary me-2 mb-2'>$object</span>";
    }

}else{
    echo "<p class='text-danger'>No detection found</p>";
}
?>

<br><br>

<!-- 🔥 FINAL IMAGE FIX -->
<?php if(isset($result["image"])) { ?>

<img src="<?php echo $result["image"]; ?>" width="450" class="img-fluid rounded shadow">

<?php } else { ?>

<p class="text-danger">Image not available</p>

<?php } ?>

</div>

</div>
</body>
</html>