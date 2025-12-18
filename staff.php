<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal - NovaPass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 28px;
            color: #1B1B1B;
        }

        .view-site-btn {
            background: #F5E7C6;
            color: black;
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .view-site-btn:hover {
            background: #1B1B1B;
            color: white;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #1B1B1B;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #F5E7C6;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1B1B1B;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .rating-input {
            display: flex;
            gap: 10px;
        }

        .rating-input input {
            width: 100px;
        }

        .btn {
            width: 100%;
            background: #F5E7C6;
            color: black;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn:hover {
            background: #1B1B1B;
            color: white;
            transform: translateY(-2px);
        }

        .product-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .product-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 12px;
            margin-bottom: 15px;
            align-items: center;
        }

        .product-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            flex: 1;
        }

        .product-info h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .product-info p {
            color: #666;
            font-size: 14px;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background: #c0392b;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #27ae60;
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            display: none;
            z-index: 1000;
        }

        .notification.show {
            display: block;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
        }

        @media (max-width: 968px) {
            .content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1><i class="fas fa-shield-alt"></i> Staff Portal</h1>
        <a href="homepage.php" class="view-site-btn">
            <i class="fas fa-home"></i> View Site
        </a>
    </div>

    <div class="content">
        <!-- Add Product Form -->
        <div class="card">
            <h2><i class="fas fa-plus-circle"></i> Add New Product</h2>
            <form id="addProductForm">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" id="productName" placeholder="e.g., iPhone 15 Pro Max" required>
                </div>

                <div class="form-group">
                    <label>Image URL</label>
                    <input type="text" id="productImage" placeholder="e.g., Homepage_img/products/phone.jpg" required>
                </div>

                <div class="form-group">
                    <label>Current Price (with $)</label>
                    <input type="text" id="productPrice" placeholder="e.g., $999" required>
                </div>

                <div class="form-group">
                    <label>Old Price (optional)</label>
                    <input type="text" id="productOldPrice" placeholder="e.g., $1,199">
                </div>

                <div class="form-group">
                    <label>Rating</label>
                    <div class="rating-input">
                        <select id="productStars" required>
                            <option value="★★★★★">★★★★★ (5 stars)</option>
                            <option value="★★★★☆">★★★★☆ (4 stars)</option>
                            <option value="★★★☆☆">★★★☆☆ (3 stars)</option>
                            <option value="★★☆☆☆">★★☆☆☆ (2 stars)</option>
                            <option value="★☆☆☆☆">★☆☆☆☆ (1 star)</option>
                        </select>
                        <input type="text" id="productRate" placeholder="e.g., (4.8)" required>
                    </div>
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </form>
        </div>

        <!-- Product List -->
        <div class="card">
            <h2><i class="fas fa-box"></i> Current Products</h2>
            <div class="product-list" id="productList">
                <!-- Products will be loaded here -->
            </div>
        </div>
    </div>
</div>

<div class="notification" id="notification"></div>

<script>
// Load products from localStorage
function getProducts() {
    const products = localStorage.getItem('novapass_products');
    return products ? JSON.parse(products) : [];
}

// Save products to localStorage
function saveProducts(products) {
    localStorage.setItem('novapass_products', JSON.stringify(products));
}

// Generate unique ID
function generateId() {
    return Date.now().toString();
}

// Show notification
function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.background = type === 'success' ? '#27ae60' : '#e74c3c';
    notification.classList.add('show');
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

// Render product list
function renderProducts() {
    const products = getProducts();
    const productList = document.getElementById('productList');
    
    if (products.length === 0) {
        productList.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>No products yet. Add your first product!</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    products.forEach(product => {
        html += `
            <div class="product-item">
                <img src="${product.image}" alt="${product.name}">
                <div class="product-info">
                    <h3>${product.name}</h3>
                    <p>${product.rating.stars} ${product.rating.rate}</p>
                    <p><strong>${product.cprice}</strong> ${product.oprice ? `<del>${product.oprice}</del>` : ''}</p>
                </div>
                <div class="product-actions">
                    <button class="delete-btn" onclick="deleteProduct('${product.id}')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        `;
    });
    
    productList.innerHTML = html;
}

// Add product
document.getElementById('addProductForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const product = {
        id: generateId(),
        name: document.getElementById('productName').value,
        image: document.getElementById('productImage').value,
        cprice: document.getElementById('productPrice').value,
        oprice: document.getElementById('productOldPrice').value || null,
        rating: {
            stars: document.getElementById('productStars').value,
            rate: document.getElementById('productRate').value
        }
    };
    
    const products = getProducts();
    products.push(product);
    saveProducts(products);
    
    showNotification('Product added successfully!');
    this.reset();
    renderProducts();
});

// Delete product
function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        let products = getProducts();
        products = products.filter(p => p.id !== id);
        saveProducts(products);
        showNotification('Product deleted!', 'error');
        renderProducts();
    }
}

// Initialize
renderProducts();
</script>

</body>
</html>