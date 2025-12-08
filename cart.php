<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart • NovaPass</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="cart-header">
            <a href="homepage.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
            <h1>Shopping Cart</h1>
        </div>

        <!-- Cart Items -->
        <div class="cart-content">
            <!-- Cart Items List -->
            <div class="cart-items">
                <!-- Item 1 -->
                <div class="cart-item">
                    <img src="Homepage_img/products/iphone.jpg" alt="iPhone 15 Pro">
                    <div class="item-details">
                        <h3>iPhone 15 Pro Max</h3>
                        <p class="item-desc">256GB • Space Black • Brand New</p>
                        <div class="price">$1,199</div>
                    </div>
                    <div class="item-actions">
                        <div class="quantity">
                            <button class="qty-btn minus">-</button>
                            <input type="number" value="1" min="1" readonly>
                            <button class="qty-btn plus">+</button>
                        </div>
                        <button class="remove-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="item-total">$1,199</div>
                </div>

                <!-- Item 2 -->
                <div class="cart-item">
                    <img src="Homepage_img/products/watch.jpg" alt="Galaxy Watch">
                    <div class="item-details">
                        <h3>Samsung Galaxy Watch 6</h3>
                        <p class="item-desc">44mm • Black • Health Tracking</p>
                        <div class="price">$349</div>
                    </div>
                    <div class="item-actions">
                        <div class="quantity">
                            <button class="qty-btn minus">-</button>
                            <input type="number" value="2" min="1" readonly>
                            <button class="qty-btn plus">+</button>
                        </div>
                        <button class="remove-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="item-total">$698</div>
                </div>

                <!-- Empty State (uncomment if cart is empty) -->
                <!--
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart empty-icon"></i>
                    <h3>Your cart is empty</h3>
                    <p>Looks like you haven't added anything yet.</p>
                    <a href="homepage.php" class="shop-now-btn">Start Shopping</a>
                </div>
                -->
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span class="price">$1,897</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span class="free">Free</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span class="total-price">$1,897</span>
                </div>
                <button class="checkout-btn">
                    <i class="fas fa-lock"></i> Proceed to Checkout
                </button>
                <div class="secure-note">
                    <i class="fas fa-shield-alt"></i>
                    Secure checkout powered by NovaPass
                </div>
            </div>
        </div>
    </div>

    <script>
      // js/cart.js - Super Simple & Clean Cart Script

document.addEventListener("DOMContentLoaded", function () {
    // Update total when + or - is clicked
    document.querySelectorAll(".qty-btn").forEach(button => {
        button.addEventListener("click", function () {
            const input = this.parentElement.querySelector("input");
            let qty = parseInt(input.value);

            if (this.classList.contains("plus")) {
                qty++;
            } else if (qty > 1) {
                qty--;
            }

            input.value = qty;
            updateCartTotals(); // Refresh everything
        });
    });

    // Remove item when trash is clicked
    document.querySelectorAll(".remove-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            this.closest(".cart-item").remove();
            updateCartTotals();
        });
    });

    // Main function: recalculate everything
    function updateCartTotals() {
        let grandTotal = 0;

        document.querySelectorAll(".cart-item").forEach(item => {
            const price = parseFloat(item.querySelector(".price").textContent.replace(/[^0-9.-]+/g, ""));
            const qty = parseInt(item.querySelector("input").value);
            const itemTotal = price * qty;

            // Update this item's total
            item.querySelector(".item-total").textContent = "$" + itemTotal.toLocaleString();

            grandTotal += itemTotal;
        });

        // Update order summary
        document.querySelector(".summary-row .price").textContent = "$" + grandTotal.toLocaleString();
        document.querySelector(".total-price").textContent = "$" + grandTotal.toLocaleString();
    }

    // Run once on page load (in case items are pre-loaded)
    updateCartTotals();
});
    </script>
</body>
</html>