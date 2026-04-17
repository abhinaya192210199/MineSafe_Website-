<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("includes/db.php");

$message = "";

if(isset($_POST['submit'])){

    // ✅ Use correct column (worker_id)
    $worker_id = $_SESSION['user_id'];

    $type = $_POST['hazard_type'];
    $desc = $_POST['description'];

    // ✅ Correct query
    $sql = "INSERT INTO hazards (worker_id, hazard_type, description) 
            VALUES ('$worker_id', '$type', '$desc')";

    if($conn->query($sql)){
        $message = "Hazard reported successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

include("layout.php");
?>

<h3 class="fw-bold mb-4">⚠ Report Hazard</h3>

<?php if($message != ""){ ?>
<div class="alert alert-success"><?php echo $message; ?></div>
<?php } ?>

<div class="card p-4">

<form method="POST">

<label class="fw-bold">Hazard Type</label>

<select name="hazard_type" class="form-control mb-3" required>
<option value="">Select Hazard</option>
<option>Gas Leak</option>
<option>Broken Equipment</option>
<option>Blocked Tunnel</option>
<option>Unsafe Machinery</option>
<option>Electrical Risk</option>
</select>

<label class="fw-bold">Description</label>

<textarea name="description" class="form-control mb-3" rows="4" placeholder="Describe the hazard..." required></textarea>

<button name="submit" class="btn btn-primary w-100 fw-bold">
Submit Hazard
</button>

</form>

</div>

</div>
</body>
</html>