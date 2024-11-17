<?php
require 'dbconn.php';
require 'assets/phpqrcode/phpqrlib.php';

if (isset($_GET['id'])) {
    $uniqueID = $_GET['id'];

    $query = "SELECT QRCodeLink FROM UserValidID WHERE UniqueID = :uniqueID";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':uniqueID' => $uniqueID]);

    $qrData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($qrData) {
        QRcode::png($qrData['QRCodeLink'], false, QR_ECLEVEL_L, 5);
    } else {
        echo "No QR code found.";
    }
}
?>
