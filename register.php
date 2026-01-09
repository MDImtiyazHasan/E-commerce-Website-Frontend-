<?php
session_start();
require_once 'db_config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($fullname) || empty($email) || empty($password)) {
        $error = 'All fields are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } else {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = 'Email already registered';
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$fullname, $email, $hashed_password])) {
                header('Location: login.php?registered=success');
                exit;
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register • NovaPass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<?php if($error): ?>
<div class="error-banner">
    <?= htmlspecialchars($error) ?>
    <span class="close-banner" onclick="this.parentElement.style.display='none'">×</span>
</div>
<?php endif; ?>

<div class="container">
    <a href="homepage.php" class="back-btn">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="logo">
        <i class="fas fa-shield-alt"></i>
    </div>

    <h1>Create Account</h1>
    <p class="subtitle">Sign up to get started</p>

    <form class="login-form" method="POST" action="">
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="fullname" placeholder="John Doe" value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>" required>
        </div>

        <div class="input-group">
            <label>E-mail Address</label>
            <input type="email" name="email" placeholder="name@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>

        <div class="input-group password-group">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="At least 6 characters" required>
            <span class="toggle-password" onclick="togglePass('password')">
                <i class="fa-regular fa-eye-slash" id="eye-icon-password"></i>
            </span>
        </div>

        <div class="input-group password-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Re-enter password" required>
            <span class="toggle-password" onclick="togglePass('confirm_password')">
                <i class="fa-regular fa-eye-slash" id="eye-icon-confirm_password"></i>
            </span>
        </div>

        <button type="submit" class="login-btn">Create Account</button>
    </form>

    <p class="signup-text">
        Already have an account? <a href="login.php">Sign in</a>
    </p>
</div>

<script>
function togglePass(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById('eye-icon-' + fieldId);
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}

// Auto-hide error banner
const banner = document.querySelector('.error-banner');
if (banner) {
    setTimeout(() => {
        banner.style.display = 'none';
    }, 6000);
}
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

.password-group:last-of-type .toggle-password {
    top: 52px;
}
</style>

</body>
</html>