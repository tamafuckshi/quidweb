
<?php
// dbconn.php - No extra spaces or lines before or after the PHP tags
try {
    $pdo = new PDO("mysql:host=localhost;dbname=testdb", "username", "password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>



