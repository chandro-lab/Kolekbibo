:/wamp64/www/kolekbibo/admin/logout.php</path>
<?php
// Start session first
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destroy session
$_SESSION = array();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
