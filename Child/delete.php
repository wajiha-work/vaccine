<?php
// Step 1: Connect to database
include 'config.php';

// Step 2: Get ID from request parameters
$id = $_GET["id"];

// Step 3: Delete record from database
$sql = "DELETE FROM CHILDREN WHERE CHILDRENID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

// Step 4: Redirect back to list of records or show confirmation message
header("Location: index.php");
exit();
?>
