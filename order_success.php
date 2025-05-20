<?php
require_once 'config.php';
$pageTitle = "Order Confirmation | Beauty Collection";
include('header.php');

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}
?>

<div class="container order-success-container">
    <div class="order-success">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Thank You For Your Order!</h1>
        <p>Your order has been placed successfully. You will receive a confirmation email shortly.</p>
        <p>Order ID: #<?php echo rand(100000, 999999); ?></p>
        <div class="success-actions">
            <a href="shop.php" class="btn btn-outline">Continue Shopping</a>
            <a href="account.php" class="btn btn-primary">View Orders</a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>