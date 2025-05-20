<?php
require_once '../config.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$pageTitle = "Admin Dashboard | Beauty Collection";
include('../header.php');

// Get total users
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

// Get total products
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();

// Get total orders
$totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();

// Get total revenue (sum of all completed orders)
$totalRevenue = $pdo->query("SELECT SUM(total_price) FROM orders WHERE status = 'completed'")->fetchColumn();
$totalRevenue = $totalRevenue ? $totalRevenue : 0;

// Get recent orders
$recentOrders = $pdo->query("
    SELECT o.*, u.username, p.name as product_name 
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN products p ON o.product_id = p.id
    ORDER BY o.order_date DESC
    LIMIT 5
")->fetchAll();

// Get order status counts
$statusCounts = $pdo->query("
    SELECT status, COUNT(*) as count 
    FROM orders 
    GROUP BY status
")->fetchAll(PDO::FETCH_KEY_PAIR);
?>

<div class="admin-container">
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="../index.php">Home</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Dashboard Overview</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p><?php echo $totalUsers; ?></p>
                <a href="users.php" class="btn btn-sm">View Users</a>
            </div>
            <div class="stat-card">
                <h3>Total Products</h3>
                <p><?php echo $totalProducts; ?></p>
                <a href="products.php" class="btn btn-sm">View Products</a>
            </div>
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p><?php echo $totalOrders; ?></p>
                <a href="orders.php" class="btn btn-sm">View Orders</a>
            </div>
            <div class="stat-card">
                <h3>Total Revenue</h3>
                <p>₱<?php echo number_format($totalRevenue, 2); ?></p>
            </div>
        </div>

        <div class="dashboard-sections">
            <div class="dashboard-section">
                <h3>Recent Orders</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrders as $order): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo htmlspecialchars($order['username']); ?></td>
                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                            <td>₱<?php echo number_format($order['total_price'], 2); ?></td>
                            <td><span class="status-badge status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="dashboard-section">
                <h3>Order Status Overview</h3>
                <div class="status-chart">
                    <?php foreach ($statusCounts as $status => $count): ?>
                    <div class="status-item">
                        <span class="status-label"><?php echo ucfirst($status); ?></span>
                        <div class="status-bar-container">
                            <div class="status-bar status-<?php echo $status; ?>" style="width: <?php echo ($count / $totalOrders) * 100; ?>%"></div>
                        </div>
                        <span class="status-count"><?php echo $count; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../footer.php'); ?>