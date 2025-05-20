<?php
require_once '../config.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$pageTitle = "Add Product | Beauty Collection";
include('../header.php');

$error = '';
$success = '';

// Define available categories
$categories = ['Makeup', 'Skincare', 'Hair Care', 'Fragrance'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $category = trim($_POST['category']);
    
    if (empty($name) || empty($price) || empty($category)) {
        $error = 'Please fill all required fields';
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = 'Price must be a positive number';
    } elseif (!in_array($category, $categories)) {
        $error = 'Invalid category selected';
    } else {
        // Handle image upload
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../images/products/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            
            // Check if image file is valid
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $image = 'images/products/' . basename($_FILES['image']['name']);
                }
            }
        }
        
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $description, $price, $image, $category])) {
            $success = 'Product added successfully!';
        } else {
            $error = 'Failed to add product';
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
        <h2>Add New Product</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name*</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price*</label>
                <input type="number" id="price" name="price" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label for="category">Category*</label>
                <select id="category" name="category" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</div>

<?php include('../footer.php'); ?>