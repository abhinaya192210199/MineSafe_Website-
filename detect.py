<?php

if(isset($_FILES['image'])){

    $upload_path = "uploads/" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);

    // 🔥 RUN PYTHON SCRIPT
    $command = "python ai/detect.py " . $upload_path;
    $output = shell_exec($command);

    // Clean path
    $output = trim($output);

    // Convert to browser path
    $image_url = str_replace("C:/xampp/htdocs", "http://localhost", $output);

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>
</head>

<body>

<h2>Detection Result</h2>

<?php if(isset($image_url)){ ?>

<img src="<?php echo $image_url; ?>" width="500">

<?php } ?>

<br><br>
<a href="upload.php">Back</a>

</body>
</html>