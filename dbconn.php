<?php
$dsn = 'mysql:host=127.0.0.1;dbname=quidDB;charset=utf8mb4';
$username = 'root';
$password = 'admin';

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
