
<?php
require_once '../config.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$pageTitle = "Manage Orders | Beauty Collection";

// Create orders table if it doesn't exist (run this once)
$pdo->exec("CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
)");

// Handle status change
if (isset($_GET['status']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    header('Location: orders.php');
    exit();
}

ob_start(); // Start output buffering
include('../header.php');

// Fetch all orders with user and product details
$stmt = $pdo->query("
    SELECT o.*, u.username, p.name as product_name 
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN products p ON o.product_id = p.id
    ORDER BY o.order_date DESC
");
$orders = $stmt->fetchAll();
?>

<div class="admin-container">
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="orders.php" class="active">Orders</a></li>
            <li><a href="../index.php">Home</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Manage Orders</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['username']); ?></td>
                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td>₱<?php echo number_format($order['total_price'], 2); ?></td>
                    <td><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                    <td>
                        <select onchange="changeStatus(this, <?php echo $order['id']; ?>)">
                            <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                            <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </td>
                    <td>
                        <a href="order_details.php?id=<?php echo $order['id']; ?>" class="btn btn-sm">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function changeStatus(selectElement, orderId) {
    const status = selectElement.value;
    window.location.href = `orders.php?status=${status}&id=${orderId}`;
}
</script>

<?php 
include('../footer.php');
ob_end_flush(); // End output buffering and flush
?>