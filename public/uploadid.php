<?php
include '../config/database.php';
session_start();

// Gather and validate form data
$userID = $_SESSION['UserID'];
$idType = $_POST['id_type'];
$idNumber = $_POST['id_number'];
$frontImage = file_get_contents($_FILES['front_image']['tmp_name']);
$backImage = file_get_contents($_FILES['back_image']['tmp_name']);

// Insert ID data into the database
$query = $conn->prepare("INSERT INTO UserValidID (UserID, ValidIDType, IDNumber, FrontIDImage, BackIDImage) VALUES (?, ?, ?, ?, ?)");
$query->execute([$userID, $idType, $idNumber, $frontImage, $backImage]);

// Get the ID for the link generation
$lastID = $conn->lastInsertId();
$uniqueLink = "viewid.php?id=" . urlencode(base64_encode($lastID));

// Redirect to QR generation
header("Location: generateqr.php?link=" . urlencode($uniqueLink));
exit;
?>
