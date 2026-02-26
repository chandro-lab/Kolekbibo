<?php
/**
 * Database Configuration for KolekBibo System
 * Using PDO for secure database connections
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'kolekbibo_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // Default WampServer password is empty

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Helper function to sanitize input
 */
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in as admin
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

/**
 * Redirect to a specific page
 */
function redirect($url) {
    header("Location: $url");
    exit();
}
