<?php
// signin.php
session_start();
// Your login logic will go here later
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - NovaPass</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Your separated CSS -->
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <i class="fas fa-shield-alt"></i>
            <div class="title">NovaPass</div>
        </div>

        <p class="subtitle">
            NovaPass is a pioneer of secure authentication platform crafted to enhance, simplify, streamline login and sign-up experience.
        </p>

        <button class="btn btn-primary" onclick="window.location.href = 'login.php'">Login</button>
        <button class="btn btn-secondary" onclick="window.location.href = 'register.php'">Sign up</button>

        <div class="divider"><span>or</span></div>

        <button class="social-btn google">
            <i class="fab fa-google"></i>
            Continue with Google
        </button>

        <button class="social-btn apple">
            <i class="fab fa-apple"></i>
            Continue with Apple
        </button>
    </div>
</body>
</html>