<?php
// dbconn.php - No extra spaces or lines before or after the PHP tags
try {
    $pdo = new PDO("mysql:host=localhost;dbname=quidDB", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>



