<?php
session_start();
require_once '../config/dbconnection.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch the user's stored IDs
$query = $pdo->prepare("SELECT uv.ValidIDType, v.ValidIDName, uv.IDNumber FROM UserValidID uv 
                        INNER JOIN ValidID v ON uv.ValidIDType = v.ValidIDType 
                        WHERE uv.UserID = ?");
$query->execute([$userId]);
$storedIds = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital IDs</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Welcome to Your Digital IDs</h1>

    <!-- Stored IDs Section -->
    <div class="stored-ids-container">
        <h2>Stored IDs</h2>
        <form method="GET" action="">
            <label for="idSelect">Select an ID:</label>
            <select name="selectedID" id="idSelect" onchange="this.form.submit()">
                <option value="">-- Select ID --</option>
                <?php foreach ($storedIds as $id): ?>
                    <option value="<?= $id['ValidIDType'] ?>" <?= isset($_GET['selectedID']) && $_GET['selectedID'] == $id['ValidIDType'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($id['ValidIDName']) ?> (<?= htmlspecialchars($id['IDNumber']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <?php if (isset($_GET['selectedID']) && !empty($_GET['selectedID'])): ?>
            <?php
            $selectedID = $_GET['selectedID'];

            // Generate QR Code for the selected ID
            $idQuery = $pdo->prepare("SELECT uv.IDNumber, v.ValidIDName FROM UserValidID uv
                                      INNER JOIN ValidID v ON uv.ValidIDType = v.ValidIDType 
                                      WHERE uv.UserID = ? AND uv.ValidIDType = ?");
            $idQuery->execute([$userId, $selectedID]);
            $idDetails = $idQuery->fetch(PDO::FETCH_ASSOC);

            if ($idDetails) {
                $qrLink = "http://yourwebsite.com/public/viewid.php?userid=$userId&idtype=$selectedID";

                // Include the QR Code Library
                require_once '../assets/phpqrlib/qrlib.php';

                // Generate QR Code
                $qrFile = '../uploads/qrcodes/' . uniqid('qrcode_') . '.png';
                QRcode::png($qrLink, $qrFile, QR_ECLEVEL_L, 5);
            ?>
            <div class="qr-display">
                <h3>QR Code for <?= htmlspecialchars($idDetails['ValidIDName']) ?>:</h3>
                <p>ID Number: <?= htmlspecialchars($idDetails['IDNumber']) ?></p>
                <img src="<?= $qrFile ?>" alt="QR Code">
                <p>Scan this QR Code to view your ID details.</p>
            </div>
            <?php } else { ?>
                <p>Invalid selection. Please choose a valid ID.</p>
            <?php } ?>
        <?php endif; ?>
    </div>
</body>
</html>
