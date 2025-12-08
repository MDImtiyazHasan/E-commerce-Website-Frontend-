<?php session_start();

// ——— UPDATE & REMOVE (all inside this file) ———
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $action = $_POST['action'] ?? '';

    if ($id && isset($_SESSION['cart'][$id])) {
        if ($action === 'remove') {
            unset($_SESSION['cart'][$id]);
        } elseif ($action === 'qty') {
            $change = (int)$_POST['change'];
            $_SESSION['cart'][$id]['qty'] += $change;
            if ($_SESSION['cart'][$id]['qty'] <= 0) unset($_SESSION['cart'][$id]);
        }
    }
    echo count($_SESSION['cart'] ?? []);
    exit;
}
?>

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

    <!-- Header -->
    <div class="cart-header">
        <a href="homepage.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Continue Shopping
        </a>
        <h1>My Cart (<?= count($_SESSION['cart'] ?? []) ?>)</h1>
    </div>

    <div class="cart-content">

        <!-- Cart Items -->
        <div class="cart-items">
            <?php if (empty($_SESSION['cart'])): ?>
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart empty-icon"></i>
                    <h3>Your cart is empty</h3>
                    <p>Looks like you haven't added anything yet.</p>
                    <a href="homepage.php" class="shop-now-btn">Start Shopping</a>
                </div>
            <?php else: ?>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <div class="cart-item">
                    <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">

                    <div class="item-details">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <p class="item-desc">In stock • Ready to ship</p>
                        <div class="price">$<?= number_format($item['price']) ?></div>
                    </div>

                    <div class="item-actions">
                        <div class="quantity">
                            <button class="qty-btn" onclick="updateQty('<?= $id ?>', -1)">−</button>
                            <input type="number" value="<?= $item['qty'] ?>" readonly>
                            <button class="qty-btn" onclick="updateQty('<?= $id ?>', 1)">+</button>
                        </div>
                        <button class="remove-btn" onclick="removeItem('<?= $id ?>')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div class="item-total">
                        $<?= number_format($item['price'] * $item['qty']) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Order Summary -->
        <?php if (!empty($_SESSION['cart'])): 
            $total = 0;
            foreach ($_SESSION['cart'] as $item) $total += $item['price'] * $item['qty'];
        ?>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>$<?= number_format($total) ?></span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span class="free">Free</span>
            </div>
            <div class="summary-row total">
                <span>Total</span>
                <span class="total-price">$<?= number_format($total) ?></span>
            </div>
            <button class="checkout-btn">
                <i class="fas fa-lock"></i> Proceed to Checkout
            </button>
            <div class="secure-note">
                <i class="fas fa-shield-alt"></i> Secure checkout powered by NovaPass
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
function updateQty(id, change) {
    fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + id + '&action=qty&change=' + change
    })
    .then(() => location.reload());
}

function removeItem(id) {
    if (confirm('Remove this item?')) {
        fetch('', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + id + '&action=remove'
        })
        .then(() => location.reload());
    }
}
</script>

</body>
</html>