<?php
require_once 'config.php';

// Check login status first
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Handle all possible redirects before any output
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $cart_id => $quantity) {
        if ($quantity <= 0) {
            $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
            $stmt->execute([$cart_id, $_SESSION['user_id']]);
        } else {
            $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$quantity, $cart_id, $_SESSION['user_id']]);
        }
    }
    header('Location: cart.php');
    exit();
}

if (isset($_GET['remove'])) {
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['remove'], $_SESSION['user_id']]);
    header('Location: cart.php');
    exit();
}

if (isset($_POST['checkout'])) {
    $stmt = $pdo->prepare("
        SELECT c.id, c.product_id, c.quantity, p.price 
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $cart_items = $stmt->fetchAll();
    
    if (count($cart_items) > 0) {
        foreach ($cart_items as $item) {
            $total_price = $item['price'] * $item['quantity'];
            $stmt = $pdo->prepare("
                INSERT INTO orders (user_id, product_id, quantity, total_price, status)
                VALUES (?, ?, ?, ?, 'pending')
            ");
            $stmt->execute([
                $_SESSION['user_id'],
                $item['product_id'],
                $item['quantity'],
                $total_price
            ]);
        }
        
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        
        header('Location: order_success.php');
        exit();
    }
}

// Now set page title and include header
$pageTitle = "Beauty Collection - Premium Cosmetics & Skincare";
include('header.php');

// Get cart items with product details
$stmt = $pdo->prepare("
    SELECT c.id as cart_id, p.id as product_id, p.name, p.price, p.image, c.quantity
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll();

// Calculate total
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = $subtotal > 1000 ? 0 : 50;
$total = $subtotal + $shipping;
?>

<div class="container cart-container">
    <h1>Your Shopping Cart</h1>
    
    <?php if (count($cart_items) > 0): ?>
        <form method="POST">
            <div class="cart-items">
                <div class="cart-header">
                    <div class="cart-header-product">Product</div>
                    <div class="cart-header-price">Price</div>
                    <div class="cart-header-quantity">Quantity</div>
                    <div class="cart-header-total">Total</div>
                    <div class="cart-header-remove"></div>
                </div>
                
                <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">
                        <div class="cart-item-product">
                            <?php if ($item['image']): ?>
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <?php else: ?>
                                <img src="images/placeholder.jpg" alt="Product placeholder">
                            <?php endif; ?>
                            <div class="cart-item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                        </div>
                        <div class="cart-item-price">₱<?php echo number_format($item['price'], 2); ?></div>
                        <div class="cart-item-quantity">
                            <input type="number" name="quantities[<?php echo $item['cart_id']; ?>]" 
                                   value="<?php echo $item['quantity']; ?>" min="1">
                        </div>
                        <div class="cart-item-total">
                            ₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>
                        <div class="cart-item-remove">
                            <a href="cart.php?remove=<?php echo $item['cart_id']; ?>" class="remove-item">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-actions">
                <a href="shop.php" class="btn btn-outline">Continue Shopping</a>
                <button type="submit" name="update_cart" class="btn">Update Cart</button>
            </div>
            
            <div class="cart-summary">
                <h2>Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>₱<?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span><?php echo $shipping == 0 ? 'FREE' : '₱' . number_format($shipping, 2); ?></span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>₱<?php echo number_format($total, 2); ?></span>
                </div>
                <button type="submit" name="checkout" class="btn btn-primary checkout-btn">Proceed to Checkout</button>
            </div>
        </form>
    <?php else: ?>
        <div class="empty-cart">
            <p>Your cart is empty</p>
            <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>