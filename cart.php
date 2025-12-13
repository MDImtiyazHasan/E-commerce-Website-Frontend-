<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart • NovaPass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>

<div class="container">
    <div class="cart-header">
        <a href="homepage.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Continue Shopping
        </a>
        <h1>My Cart (<span id="cartCountHeader">0</span>)</h1>
    </div>

    <div class="cart-content">
        <div class="cart-items" id="cartItemsContainer"></div>
        <div class="order-summary" id="orderSummary" style="display: none;"></div>
    </div>
</div>

<script>
// Load cart from localStorage
function getCart() {
    const cart = localStorage.getItem('novapass_cart');
    return cart ? JSON.parse(cart) : {};
}

// Save cart to localStorage
function saveCart(cart) {
    localStorage.setItem('novapass_cart', JSON.stringify(cart));
}

// Get cart count (total quantity of all items)
function getCartCount(cart) {
    let totalQty = 0;
    for (let id in cart) {
        totalQty += cart[id].qty;
    }
    return totalQty;
}

// Format price
function formatPrice(price) {
    return price.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
}

// Escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Update quantity
function updateQty(id, change) {
    let cart = getCart();
    
    if (cart[id]) {
        cart[id].qty += change;
        
        if (cart[id].qty <= 0) {
            delete cart[id];
        }
        
        saveCart(cart);
        renderCart();
    }
}

// Remove item
function removeItem(id) {
    if (confirm('Remove this item?')) {
        let cart = getCart();
        delete cart[id];
        saveCart(cart);
        renderCart();
    }
}

// Checkout
function checkout() {
    alert('Proceeding to checkout...');
}

// Render cart
function renderCart() {
    const cart = getCart();
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const orderSummary = document.getElementById('orderSummary');
    const cartCountHeader = document.getElementById('cartCountHeader');
    
    const count = getCartCount(cart);
    cartCountHeader.textContent = count;
    
    if (count === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-cart">
                <i class="fas fa-shopping-cart empty-icon"></i>
                <h3>Your cart is empty</h3>
                <p>Looks like you haven't added anything yet.</p>
                <a href="homepage.php" class="shop-now-btn">Start Shopping</a>
            </div>
        `;
        orderSummary.style.display = 'none';
    } else {
        let itemsHTML = '';
        let total = 0;
        
        for (let id in cart) {
            const item = cart[id];
            const itemTotal = item.price * item.qty;
            total += itemTotal;
            
            itemsHTML += `
                <div class="cart-item">
                    <img src="${item.image}" alt="${escapeHtml(item.name)}">
                    <div class="item-details">
                        <h3>${escapeHtml(item.name)}</h3>
                        <p class="item-desc">In stock • Ready to ship</p>
                        <div class="price">$${formatPrice(item.price)}</div>
                    </div>
                    <div class="item-actions">
                        <div class="quantity">
                            <button class="qty-btn" onclick="updateQty('${id}', -1)">−</button>
                            <input type="number" value="${item.qty}" readonly>
                            <button class="qty-btn" onclick="updateQty('${id}', 1)">+</button>
                        </div>
                        <button class="remove-btn" onclick="removeItem('${id}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="item-total">$${formatPrice(itemTotal)}</div>
                </div>
            `;
        }
        
        cartItemsContainer.innerHTML = itemsHTML;
        
        orderSummary.innerHTML = `
            <h2>Order Summary</h2>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>$${formatPrice(total)}</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span class="free">Free</span>
            </div>
            <div class="summary-row total">
                <span>Total</span>
                <span class="total-price">$${formatPrice(total)}</span>
            </div>
            <button class="checkout-btn" onclick="checkout()">
                <i class="fas fa-lock"></i> Proceed to Checkout
            </button>
            <div class="secure-note">
                <i class="fas fa-shield-alt"></i> Secure checkout powered by NovaPass
            </div>
        `;
        orderSummary.style.display = 'block';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    renderCart();
});
</script>

</body>
</html>