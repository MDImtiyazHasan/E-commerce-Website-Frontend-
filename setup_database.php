<?php
// setup_database.php - Run this file ONCE to create the database and table

$host = 'localhost';
$username = 'root';
$password = '';  // If MySQL has a password, enter it here (common: 'root', '', or 'mysql')

echo "<h2>Setting up database...</h2>";

try {
    // Connect without database first
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Connected to MySQL successfully!<br>";
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS novapass_db");
    echo "✓ Database 'novapass_db' created successfully!<br>";
    
    // Use the database
    $pdo->exec("USE novapass_db");
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "✓ Table 'users' created successfully!<br>";
    
    echo "<br><strong style='color: green;'>✅ Setup Complete!</strong><br>";
    echo "You can now:<br>";
    echo "1. Delete this file (setup_database.php)<br>";
    echo "2. Go to <a href='register.php'>register.php</a> to create an account<br>";
    echo "3. Then <a href='login.php'>login.php</a> to sign in<br>";
    
} catch(PDOException $e) {
    echo "<div style='color: red; padding: 20px; background: #ffe6e6; border-radius: 8px;'>";
    echo "<strong>❌ Error:</strong> " . $e->getMessage() . "<br><br>";
    echo "<strong>Common Solutions:</strong><br>";
    echo "1. Make sure XAMPP/WAMP MySQL is running (green light)<br>";
    echo "2. Check your MySQL password:<br>";
    echo "&nbsp;&nbsp;&nbsp;- Try: <code>\$password = '';</code> (empty)<br>";
    echo "&nbsp;&nbsp;&nbsp;- Try: <code>\$password = 'root';</code><br>";
    echo "&nbsp;&nbsp;&nbsp;- Try: <code>\$password = 'mysql';</code><br>";
    echo "3. Open phpMyAdmin to check your credentials<br>";
    echo "4. Edit line 5 in this file with correct password<br>";
    echo "</div>";
}
?>