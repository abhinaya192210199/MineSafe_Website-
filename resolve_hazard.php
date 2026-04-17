<?php
include("includes/db.php");

$id = $_GET['id'];

$conn->query("UPDATE hazards SET status='Resolved' WHERE id=$id");

header("Location: supervisor_panel.php");
?>