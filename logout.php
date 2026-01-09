<?php
// logout.php - Logout Handler

session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Clear remember me cookie
setcookie('user_email', '', time() - 3600, '/');

// Redirect to login page
header('Location: login.php');
exit;
?>