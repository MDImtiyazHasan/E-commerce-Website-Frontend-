<?php
// db_config.php - Database Configuration

$host = 'localhost';
$dbname = 'novapass_db';
$username = 'root';
$password = '';  // If you have a password, enter it here (e.g., 'your_password')

try {
    // First, try to connect without specifying database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    
    // Now connect to the specific database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage() . "<br><br>
    <strong>Troubleshooting:</strong><br>
    1. Make sure MySQL is running in XAMPP/WAMP<br>
    2. Check if you need a password for MySQL<br>
    3. Try setting password to 'root' or your MySQL password<br>
    4. Open phpMyAdmin and check your MySQL credentials");
}
?>