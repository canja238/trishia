<?php
require_once '../config.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$pageTitle = "Edit Product | Beauty Collection";
include('../header.php');

// Get product details
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: products.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    
    if (empty($name) || empty($price)) {
        $error = 'Please fill all required fields';
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = 'Price must be a positive number';
    } else {
        // Handle image upload
        $image = $product['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../images/products/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            
            // Check if image file is valid
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    // Delete old image if it exists
                    if ($image && file_exists('../' . $image)) {
                        unlink('../' . $image);
                    }
                    $image = 'images/products/' . basename($_FILES['image']['name']);
                }
            }
        }
        
        $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
        if ($stmt->execute([$name, $description, $price, $image, $id])) {
            $success = 'Product updated successfully!';
            // Refresh product data
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch();
        } else {
            $error = 'Failed to update product';
        }
    }
}
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
        <h2>Edit Product</h2>
        <a href="products.php" class="btn btn-sm">Back to Products</a>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data" class="mt-3">
            <div class="form-group">
                <label for="name">Product Name*</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price*</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <?php if ($product['image']): ?>
                    <div class="current-image">
                        <img src="../<?php echo $product['image']; ?>" alt="Current product image" style="max-width: 200px; display: block; margin-bottom: 10px;">
                        <label>
                            <input type="checkbox" name="remove_image" value="1"> Remove current image
                        </label>
                    </div>
                <?php endif; ?>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>

<?php include('../footer.php'); ?>