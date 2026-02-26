<?php
require_once '../config/db.php';

// Check if already logged in
if (isAdminLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';
$success = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        // Fetch admin from database
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();
        
        // Verify password (supports both hashed and legacy plain text)
        $password_valid = false;
        if ($admin) {
            if (password_get_info($admin['password'])['algo'] !== 0) {
                // Password is hashed
                $password_valid = password_verify($password, $admin['password']);
            } else {
                // Legacy plain text password (for backward compatibility)
                $password_valid = ($password === $admin['password']);
            }
        }
        
        if ($admin && $password_valid) {
            // Login successful
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            
            // Upgrade plain text password to hashed (optional security improvement)
            if (password_get_info($admin['password'])['algo'] === 0) {
                $new_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE id = ?");
                $stmt->execute([$new_hash, $admin['id']]);
            }
            
            redirect('dashboard.php');
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - KolekBibo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2><img src="../images/Kolekbibo logo.jfif" alt="KolekBibo Logo" style="height: 50px; margin-right: 10px;"> KolekBibo</h2>
            <h3 style="text-align: center; margin-bottom: 20px; color: var(--dark-gray);">Admin Login</h3>
            
            <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form action="" method="POST" class="needs-validation">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-block">Login</button>
            </form>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="../index.php" style="color: var(--medium-gray);"><i class="fas fa-arrow-left"></i> Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>
