<?php
session_start();
require_once 'db.php';
require_once 'product_model.php';


if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product = getProductById($conn, $product_id);

    if ($product) {
        $_SESSION['cart'][] = $product;
    }
    header("Location: index.php");
    exit();
}

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    header("Location: index.php");
    exit();
}
?>

