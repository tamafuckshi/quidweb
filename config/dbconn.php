<?php
// Database connection settings
$host = 'localhost';
$dbname = 'quidDB';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


//query
try {
    $query = "Select * from users";
    $stmt = $pdo->$query($query);

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        echo "ID: {$user['id']} | Username: {$user['username']} | Email: {$user['email']}<br>";
    }
} catch (PDOException $e) {
    echo "Error fetching users: ". $e-> getMessage();
}
?>
    


