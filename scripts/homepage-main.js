
class CartManager {
    constructor() {
        this.cart = this.loadCart();
    }

    loadCart() {
        const savedCart = localStorage.getItem('novapass_cart');
        return savedCart ? JSON.parse(savedCart) : {};
    }

    saveCart() {
        localStorage.setItem('novapass_cart', JSON.stringify(this.cart));
    }

    addToCart(id, name, price, image) {
        if (this.cart[id]) {
            this.cart[id].qty++;
        } else {
            this.cart[id] = {
                name: name,
                price: parseFloat(price),
                image: image,
                qty: 1
            };
        }
        this.saveCart();
        return this.getCartCount();
    }

    getCartCount() {
        let totalQty = 0;
        for (let id in this.cart) {
            totalQty += this.cart[id].qty;
        }
        return totalQty;
    }
}

// Initialize cart manager
const cartManager = new CartManager();

// ========================================
// BUILD PRODUCT CARDS
// ========================================
let html = '';
products.forEach(p => {
    html += `
        <div class="product-card">
            <div class="product-image">
                <img src="${p.image}" alt="${p.name}">
                <button class="wishlist-btn"><i class="far fa-heart"></i></button>
            </div>
            <div class="product-info">
                <h3 class="product-title">${p.name}</h3>
                <div class="product-rating">
                    <span class="stars">${p.rating.stars}</span>
                    <span class="rating-text">${p.rating.rate}</span>
                </div>
                <div class="product-price">
                    <span class="current-price">${p.cprice}</span>
                    ${p.oprice ? `<span class="old-price">${p.oprice}</span>` : ''}
                </div>
                <button class="add-to-cart-btn" 
                        data-id="${p.id}" 
                        data-name="${p.name}" 
                        data-price="${p.cprice.replace(/[^0-9]/g,'')}"
                        data-image="${p.image}">
                    Add to Cart
                </button>
            </div>
        </div>`;
});

document.querySelector('.js-products-grid').innerHTML = html;

// ========================================
// ADD TO CART FUNCTIONALITY
// IMPORTANT: This must come AFTER innerHTML is set
// ========================================
document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const name = this.dataset.name;
        const price = this.dataset.price;
        const image = this.dataset.image;

        // Add to cart using JavaScript
        const newCount = cartManager.addToCart(id, name, price, image);
        
        // Update cart count in header
        document.querySelector('.cart-count').textContent = newCount;
        
        // Button feedback
        this.textContent = 'Added!';
        this.style.background = 'green';
        this.style.color = 'white';
        
        // Show notification
        showNotification('Item added to cart!');
        
        // Reset button after 1 second
        setTimeout(() => {
            this.textContent = 'Add to Cart';
            this.style.background = '#F5E7C6';
            this.style.color = 'black';
        }, 1000);
    });
});

// ========================================
// SHOW NOTIFICATION
// ========================================
function showNotification(message) {
    let notification = document.getElementById('cartNotification');
    
    if (!notification) {
        notification = document.createElement('div');
        notification.id = 'cartNotification';
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: #27ae60;
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            display: none;
            align-items: center;
            gap: 10px;
            z-index: 10000;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            animation: slideIn 0.3s ease;
        `;
        document.body.appendChild(notification);
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    }
    
    notification.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span>${message}</span>
    `;
    notification.style.display = 'flex';
    
    setTimeout(() => {
        notification.style.display = 'none';
    }, 2000);
}

// ========================================
// UPDATE CART COUNT ON PAGE LOAD
// ========================================
const cartCountElement = document.querySelector('.cart-count');
if (cartCountElement) {
    cartCountElement.textContent = cartManager.getCartCount();
}