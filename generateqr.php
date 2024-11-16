<?php
include 'dbconn..php';
require '../assets/phpqrcode/qrlib.php';

$link = urldecode($_GET['link']);
$userID = $_SESSION['UserID'];

// Define QR Code path
$qrCodePath = '../uploads/qrcodes/' . md5($link) . '.png';
QRcode::png($link, $qrCodePath);

// Optionally store in the QRCodeLog table
$query = $conn->prepare("INSERT INTO QRCodeLog (UserID, Action) VALUES (?, 'Generated')");
$query->execute([$userID]);

// Redirect to view QR or display success
header("Location: viewid.php?id=" . urlencode(base64_decode($_GET['link'])));
exit;
?>
