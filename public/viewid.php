<?php
require 'config/dbconnection.php';

$userId = $_GET['id'];
$idType = $_GET['type'];

$query = "SELECT * FROM UserValidID WHERE UserID = ? AND ValidIDType = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$userId, $idType]);
$idDetails = $stmt->fetch();

if ($idDetails) {
    echo "<h1>ID Details</h1>";
    echo "<p>ID Number: " . htmlspecialchars($idDetails['IDNumber']) . "</p>";
    echo '<img src="data:image/png;base64,' . base64_encode($idDetails['FrontIDImage']) . '" alt="Front ID">';
    echo '<img src="data:image/png;base64,' . base64_encode($idDetails['BackIDImage']) . '" alt="Back ID">';
} else {
    echo "Invalid ID.";
}
?>
