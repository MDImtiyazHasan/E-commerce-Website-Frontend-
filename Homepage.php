<?php 
session_start();
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $_SESSION['user_name'] ?? 'Guest';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaPass - Home</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Your CSS -->
    <link rel="stylesheet" href="Css/homepage.css">
</head>
<body>

    <!-- HEADER -->
    <header class="header">
        <div class="header-container">
            <a href="homepage.php">
                <i class="fas fa-shield-alt"></i>
            </a>

            <button class="delivery-btn">
                <i class="fas fa-map-marker-alt"></i>
                Deliver to
            </button>

            <div class="search-bar">
                <input type="search" placeholder="Search products, brands, categories...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <select class="language-select">
                <option>EN</option>
                <option>BN</option>
            </select>

          <button class="cart-btn" onclick="location.href='cart.php'">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
                <span class="cart-count">0</span>
          </button>

            <?php if($is_logged_in): ?>
                <div class="user-menu">
                    <button class="signin-btn" onclick="toggleUserMenu()">
                        <i class="fas fa-user-circle"></i>
                        <span><?= htmlspecialchars($user_name) ?></span>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
                        <a href="orders.php"><i class="fas fa-box"></i> My Orders</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" class="signin-btn">
                    <i class="fas fa-user-circle"></i>
                    <span>Sign in</span>
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- CATEGORY NAV -->
    <nav class="category-nav">
        <div class="category-container">
            <div class="category-item active">
                <i class="fas fa-bars"></i> All Categories
            </div>
            <div class="category-item">Electronics</div>
            <div class="category-item">Fashion</div>
            <div class="category-item">Beauty</div>
            <div class="category-item">Groceries</div>
            <div class="category-item">Home & Living</div>
            <div class="category-item">Sports</div>
            <div class="category-item">Books</div>
            <div class="category-item">Toys</div>
            <div class="category-item">Health</div>
        </div>
    </nav>

    <!-- HERO BANNER -->
    <section class="hero">
        <div class="hero-left" style="background-image: url('Homepage_img/Banner.jpg');">
            <div class="hero-content">
                <h2>Biggest Sale of the Year</h2>
                <p>Up to 70% off on electronics</p>
                <a href="#shop" class="cta-btn">Shop Now</a>
            </div>
        </div>
        <div class="hero-right" style="background-image: url('Homepage_img/Banner1.jpg');">
            <div class="hero-content">
                <h2>Fashion Fiesta</h2>
                <p>New trends, new you</p>
                <a href="#shop" class="cta-btn">Explore</a>
            </div>
        </div>
    </section>

    <!-- POPULAR CATEGORIES -->
    <section class="popular-categories">
        <h2 class="section-title">Explore Popular Categories</h2>
        <div class="categories-grid">
            <a href="#" class="cat-card">
                <img src="Homepage_img/headphones.jpg" alt="Electronics">
                <p>Electronics</p>
            </a>
            <a href="#" class="cat-card">
                <img src="Homepage_img/clothing.jpg" alt="Fashion">
                <p>Fashion</p>
            </a>
            <a href="#" class="cat-card">
                <img src="Homepage_img/perfume.jpg" alt="Beauty">
                <p>Beauty</p>
            </a>
            <a href="#" class="cat-card">
                <img src="Homepage_img/food.jpg" alt="Groceries">
                <p>Groceries</p>
            </a>
            <a href="#" class="cat-card">
                <img src="Homepage_img/home.jpg" alt="Home & Living">
                <p>Home & Living</p>
            </a>
            <a href="#" class="cat-card">
                <img src="Homepage_img/sports.jpg" alt="Sports">
                <p>Sports</p>
            </a>
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section class="featured-products">
        <div class="section-header">
            <h2 class="section-title">Featured Products</h2>
            <a href="#" class="view-all">View All →</a>
        </div>

        <div class="products-grid js-products-grid">
            <!-- Products will be loaded here by JavaScript -->
        </div>
    </section>

    <!-- Your existing scripts -->
    <script src="data/homepage.js"></script>
    <script src="scripts/homepage-main.js"></script>

     <script>
    // User menu toggle
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const userMenu = document.querySelector('.user-menu');
        if (userMenu && !userMenu.contains(e.target)) {
            document.getElementById('userDropdown').style.display = 'none';
        }
    });
    </script>

    <style>
    .user-menu {
        position: relative;
    }

    .user-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 10px;
        background: white;
        border: 1px solid #F5E7C6;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        min-width: 200px;
        z-index: 1000;
    }

    .user-dropdown a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        color: #1B1B1B;
        text-decoration: none;
        transition: 0.3s;
    }

    .user-dropdown a:first-child {
        border-radius: 12px 12px 0 0;
    }

    .user-dropdown a:last-child {
        border-radius: 0 0 12px 12px;
    }

    .user-dropdown a:hover {
        background: #F5E7C6;
    }
    </style>

</body>
</html>