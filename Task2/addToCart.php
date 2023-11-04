<?php
require_once('classes.php'); 
include('cart.php');
session_start();

$productName = $_POST['product'];
$quantity = (int)$_POST['quantity'];
$product = findProductByName($productName); 

if ($product) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new Cart();
    }
    
    $_SESSION['cart']->addItem($product, $quantity);
}

// Redirect back to the homepage
header('Location: index.html');
