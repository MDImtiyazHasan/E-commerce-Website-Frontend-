<?php session_start(); 
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; 
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
                <span class="cart-count"><?= $cart_count ?></span>
          </button>

            <a href="Signin.php" class="signin-btn" >
                <i class="fas fa-user-circle"></i>
                <span>Sign in</span>
            </a>
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
          
            
        </div>
    </section>

    <script src="data/homepage.js"></script>
    <script src="scripts/homepage-main.js"></script>

</body>
</html>