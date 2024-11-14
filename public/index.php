<?php
session_start();
require_once 'config/dbconnection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch user information
$stmt = $pdo->prepare("SELECT * FROM User WHERE UserID = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Fetch uploaded IDs
$idStmt = $pdo->prepare("SELECT ValidIDName, IDNumber FROM UserValidID 
                         JOIN ValidID ON UserValidID.ValidIDType = ValidID.ValidIDType 
                         WHERE UserID = ?");
$idStmt->execute([$userId]);
$uploadedIDs = $idStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
    <h2>Profile</h2>
    <p>Name: <?php echo htmlspecialchars($user['FirstName'] . ' ' . $user['LastName']); ?></p>
    <p>Student Number: <?php echo htmlspecialchars($user['StudentNumber']); ?></p>
    <p><a href="upload_id.php">Upload a New ID</a></p>

    <h3>Your Uploaded IDs</h3>
    <?php if ($uploadedIDs): ?>
        <ul>
            <?php foreach ($uploadedIDs as $id): ?>
                <li><?php echo htmlspecialchars($id['ValidIDName'] . ': ' . $id['IDNumber']); ?> - 
                    <a href="view_id.php?id=<?php echo $id['IDNumber']; ?>">View QR Code</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No IDs uploaded yet.</p>
    <?php endif; ?>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
