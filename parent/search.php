<?php



// Step 1: Connect to database
include 'config.php';

// Step 2: Get ID from request parameters
$PARENT_NAME = $_GET["PARENT_NAME"];

// Step 3: Delete record from database
$sql = "SELECT * FROM parent WHERE PARENT_NAME = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PARENT_NAME);
$stmt->execute();

// Step 4: Redirect back to list of records or show confirmation message
header("Location: index.php");
exit();










?>
 