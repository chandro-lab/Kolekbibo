<?php
/**
 * Database Setup for KolekBibo Activity Management System
 * Run this file once to create the database and tables
 */

// Database credentials
$host = 'localhost';
$username = 'root';
$password = ''; // Default WampServer password

try {
    // Connect without database first
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS kolekbibo_db");
    $pdo->exec("USE kolekbibo_db");
    
    // Create admins table
    $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create activities table
    $pdo->exec("CREATE TABLE IF NOT EXISTS activities (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        activity_date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status ENUM('Published','Draft') DEFAULT 'Draft'
    )");
    
    // Create contacts table
    $pdo->exec("CREATE TABLE IF NOT EXISTS contacts (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        is_read ENUM('0','1') DEFAULT '0'
    )");
    
    // Check if admin exists, if not create default admin with hashed password
    $stmt = $pdo->prepare("SELECT id FROM admins WHERE username = ?");
    $stmt->execute(['admin']);
    
    if ($stmt->rowCount() == 0) {
        // Hash the password
        $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $stmt->execute(['admin', $hashedPassword]);
        echo "Default admin created! Username: admin | Password: admin123<br>";
    } else {
        // Update existing admin to use hashed password
        $stmt = $pdo->prepare("SELECT password FROM admins WHERE username = ?");
        $stmt->execute(['admin']);
        $admin = $stmt->fetch();
        
        // If password is not hashed, update it
        if (password_get_info($admin['password'])['algo'] === 0) {
            $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE username = ?");
            $stmt->execute([$hashedPassword, 'admin']);
            echo "Admin password updated to hashed!<br>";
        }
    }
    
    echo "Database setup completed successfully!<br>";
    echo "<a href='index.php'>Go to Homepage</a> | <a href='admin/login.php'>Go to Admin Login</a>";
    
} catch (PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}
