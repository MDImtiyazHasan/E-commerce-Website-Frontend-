<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register • NovaPass</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="container">
        <!-- Back Button -->
        <a href="login.php" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>

        <!-- Logo -->
        <div class="logo">
            <i class="fas fa-shield-alt"></i>
        </div>

        <h1>Register</h1>

        <form class="register-form" id="registerForm">
            <!-- Email -->
            <div class="input-group">
                <label>Enter your email</label>
                <input type="email" name="email" placeholder="name@example.com" required>
            </div>

            <!-- Password -->
            
            <div class="input-group password-group">
                <label>Enter your password</label>
                <input type="password" name="password" id="password" placeholder="Create a strong password" required minlength="6">
                <span class="toggle-password" onclick="togglePass('password', 'eye1')">
                    <i class="far fa-eye-slash" id="eye1"></i>
                </span>
            </div>

            <!-- Confirm Password -->
            <div class="input-group password-group">
                <label>Re-Enter your password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
                <span class="toggle-password" onclick="togglePass('confirm_password', 'eye2')">
                    <i class="far fa-eye-slash" id="eye2"></i>
                </span>
            </div>

            <!-- Sign Up Button - Now redirects to login.php after basic check -->
            <button type="button" class="signup-btn" onclick="handleSignup()">
                Sign Up
            </button>
        </form>

        <div class="divider"><span>Or</span></div>

        <!-- Social Buttons -->
        <button class="social-btn google">
            <i class="fab fa-google"></i>
            Continue with Google
        </button>

        <button class="social-btn apple">
            <i class="fab fa-apple"></i>
            Continue with Apple
        </button>

        <!-- Login Link -->
        <p class="login-text">
            Don't have an account? <a href="login.php">Sign in</a>
        </p>
    </div>

    <script>
        function togglePass(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        // Optional: Simple client-side password match check
        document.getElementById('registerForm').onsubmit = function(e) {
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;
            if (pass !== confirm) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        };

        function handleSignup() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const email = document.querySelector('input[name="email"]').value;

        // Basic validation
        if (!email) {
            alert('Please enter your email');
            return;
        }
        if (password.length < 6) {
            alert('Password must be at least 6 characters');
            return;
        }
        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return;
        }

        // Everything good → go to login page with success message
        window.location.href = "login.php?registered=success";
    };
    </script>
</body>
</html>