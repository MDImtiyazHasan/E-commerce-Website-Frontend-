

<?php
session_start();
require_once 'db_config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error = 'Please enter both email and password';
    } else {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT id, fullname, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['user_email'] = $user['email'];
            
            // Remember me functionality
            if (isset($_POST['remember'])) {
                setcookie('user_email', $email, time() + (86400 * 30), '/'); // 30 days
            }
            
            header('Location: homepage.php');
            exit;
        } else {
            $error = 'Invalid email or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login • NovaPass</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<!-- Put this right after <body> or right before your .container in login.php -->
<?php if(isset($_GET['registered']) && $_GET['registered'] === 'success'): ?>
<div class="success-banner">
    Account created successfully! Please log in.
    <span class="close-banner" onclick="this.parentElement.style.display='none'">×</span>
</div><?php endif; ?>

<?php if($error): ?>
<div class="error-banner">
    <?= htmlspecialchars($error) ?>
    <span class="close-banner" onclick="this.parentElement.style.display='none'">×</span>
</div>
<?php endif; ?>

<body>

    <div class="container">
        <a href="homepage.php" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>

        <div class="logo">
            <i class="fas fa-shield-alt"></i>
        </div>

        <h1>Login</h1>
        <p class="subtitle">Please login to your account</p>

        <form class="login-form" id="loginForm">
            <div class="input-group">
                <label>E-mail Address</label>
                <input type="email" name="email" placeholder="name@example.com" required>
            </div>

            <div class="input-group password-group">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <span class="toggle-password" onclick="togglePass()">
                    
                    <i class="fa-regular fa-eye-slash" id="eye-icon"></i>
                </span>
            </div>

            <div class="options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span class="checkmark"></span>
                    Remember me
                </label>
                <a href="#" class="forgot-link">Forgot password?</a>
            </div>

            <button type="button" class="login-btn" onclick="handleLogin()">Login</button>
        </form>

        <div class="divider"><span>Or</span></div>

        <button class="social-btn google">
            <i class="fab fa-google"></i>
            Continue with Google
        </button>

        <button class="social-btn apple">
            <i class="fab fa-apple"></i>
            Continue with Apple
        </button>

        <p class="signup-text">
            Don't have account? <a href="register.php">Sign up</a>
        </p>
    </div>

    <script>
        function togglePass() {
            const field = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        
        
        }

        // Auto-hide the banner after 6 seconds
    const banner = document.querySelector('.success-banner');
    if (banner) {
        setTimeout(() => {
            banner.classList.add('hide');
            setTimeout(() => banner.remove(), 400);
        }, 6000);
    };


        
    </script>

    
<style>
.error-banner {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 500;
    box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
    z-index: 10000;
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideDown 0.5s ease;
}
</style>
</body>


</html>