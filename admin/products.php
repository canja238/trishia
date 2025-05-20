
<?php
require_once '../config.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$pageTitle = "Manage Products | Beauty Collection";
include('../header.php');

// Handle product deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // First get the product image path
    $stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    
    if ($product) {
        // Delete the product
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        
        // Delete the image file if it exists
        if ($product['image'] && file_exists('../' . $product['image'])) {
            unlink('../' . $product['image']);
        }
        
        $_SESSION['success_message'] = 'Product deleted successfully';
    }
    
    header('Location: products.php');
    exit();
}

// Display success message if set
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}

// Fetch all products
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>

<div class="admin-container">
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php" class="active">Products</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="../index.php">Home</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Manage Products</h2>
        <a href="add_product.php" class="btn btn-primary">Add New Product</a>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td>
                        <?php if ($product['image']): ?>
                            <img src="../<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 50px; max-height: 50px;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($product['category'] ?? 'Uncategorized'); ?></td>
                    <td>₱<?php echo number_format($product['price'], 2); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm">Edit</a>
                        <a href="products.php?delete=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../footer.php'); ?>