<?php
// add-to-cart.php - ONLY 15 LINES!
session_start();

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$id = $_POST['id'] ?? '';

if ($id) {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty']++;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'image' => $_POST['image'],
            'qty' => 1
        ];
    }
}

echo count($_SESSION['cart']); // returns new cart count
?>