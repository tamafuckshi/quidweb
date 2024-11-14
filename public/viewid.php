<?php
include '../config/database.php';

$id = base64_decode($_GET['id']);
$query = $conn->prepare("SELECT * FROM UserValidID WHERE UserID = ?");
$query->execute([$id]);
$idData = $query->fetch(PDO::FETCH_ASSOC);

if ($idData) {
    echo "ID Type: " . htmlspecialchars($idData['ValidIDType']);
    echo "ID Number: " . htmlspecialchars($idData['IDNumber']);
    echo '<img src="data:image/jpeg;base64,' . base64_encode($idData['FrontIDImage']) . '" />';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($idData['BackIDImage']) . '" />';
} else {
    echo "Invalid ID.";
}
?>
