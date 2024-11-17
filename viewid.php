<?php
require 'dbconn.php';

if (isset($_GET['id'])) {
    $uniqueID = $_GET['id'];

    $query = "SELECT * FROM UserValidID WHERE UniqueID = :uniqueID";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':uniqueID' => $uniqueID]);

    $idDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($idDetails) {
        echo "<h1>ID Details</h1>";
        echo "<p>ID Type: {$idDetails['ValidIDType']}</p>";
        echo "<p>ID Number: {$idDetails['IDNumber']}</p>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($idDetails['FrontIDImage']) . "' alt='Front ID'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($idDetails['BackIDImage']) . "' alt='Back ID'>";
    } else {
        echo "No ID found.";
    }
}
?>
