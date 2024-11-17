<?php
require 'dbconn.php';
require 'assets/phpqrcode/phpqrlib.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['user_id'];
    $idType = $_POST['id_type'];
    $idNumber = $_POST['id_number'];
    $frontImage = file_get_contents($_FILES['front_image']['tmp_name']);
    $backImage = file_get_contents($_FILES['back_image']['tmp_name']);

    // Generate a unique ID
    $uniqueID = uniqid("user_$userID" . "_id_");
    $qrLink = "http://yourdomain.com/viewid.php?id=" . $uniqueID;

    // Insert into UserValidID table
    $query = "INSERT INTO UserValidID (UserID, ValidIDType, IDNumber, FrontIDImage, BackIDImage, UniqueID, QRCodeLink)
              VALUES (:userID, :idType, :idNumber, :frontImage, :backImage, :uniqueID, :qrLink)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':userID' => $userID,
        ':idType' => $idType,
        ':idNumber' => $idNumber,
        ':frontImage' => $frontImage,
        ':backImage' => $backImage,
        ':uniqueID' => $uniqueID,
        ':qrLink' => $qrLink
    ]);

    // Generate QR Code and save it
    $qrCodePath = "uploads/qrcodes/$uniqueID.png";
    QRcode::png($qrLink, $qrCodePath, QR_ECLEVEL_L, 5);

    echo "ID uploaded and QR code generated successfully.";
}
?>
