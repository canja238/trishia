<?php
require_once 'config.php';

// Add to cart functionality - moved to top
if (isset($_POST['add_to_cart'])) {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
    
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'] ?? 1;
    
    // Check if product already in cart
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$_SESSION['user_id'], $product_id]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        // Update quantity
        $new_quantity = $existing['quantity'] + $quantity;
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->execute([$new_quantity, $existing['id']]);
    } else {
        // Add new item
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $product_id, $quantity]);
    }
    
    header('Location: cart.php');
    exit();
}

// Set page title and include header
$pageTitle = "Shop | Beauty Collection";
include('header.php');

// Get products
$category = $_GET['category'] ?? null;
$search = $_GET['search'] ?? null;

$query = "SELECT * FROM products";
$params = [];

if ($category) {
    $query .= " WHERE category = ?";
    $params = [$category];
} elseif ($search) {
    $query .= " WHERE name LIKE ? OR description LIKE ?";
    $params = ["%$search%", "%$search%"];
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<div class="container shop-container">
    <div class="shop-header">
        <h1>Our Products</h1>
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    
    <div class="shop-filters">
        <div class="filter-categories">
            <a href="shop.php" class="<?php echo !$category ? 'active' : ''; ?>">All</a>
            <a href="shop.php?category=Makeup" class="<?php echo $category == 'Makeup' ? 'active' : ''; ?>">Makeup</a>
            <a href="shop.php?category=Skincare" class="<?php echo $category == 'Skincare' ? 'active' : ''; ?>">Skincare</a>
            <a href="shop.php?category=Hair Care" class="<?php echo $category == 'Hair Care' ? 'active' : ''; ?>">Hair Care</a>
            <a href="shop.php?category=Fragrance" class="<?php echo $category == 'Fragrance' ? 'active' : ''; ?>">Fragrance</a>
        </div>
    </div>
    
    <div class="products-grid">
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if ($product['image']): ?>
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" loading="lazy">
                        <?php else: ?>
                            <img src="images/placeholder.jpg" alt="Product placeholder" loading="lazy">
                        <?php endif; ?>
                        <div class="product-actions">
                            <button class="quick-view" data-id="<?php echo $product['id']; ?>">Quick View</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                        <div class="product-price">₱<?php echo number_format($product['price'], 2); ?></div>
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn minus">-</button>
                                <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                                <button type="button" class="quantity-btn plus">+</button>
                            </div>
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                <p>No products found. Try a different search.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Quick View Modal -->
<div class="modal" id="quickViewModal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="modal-product">
            <div class="modal-product-image">
                <img id="modalProductImage" src="" alt="">
            </div>
            <div class="modal-product-info">
                <h2 id="modalProductName"></h2>
                <div class="modal-product-price" id="modalProductPrice"></div>
                <p id="modalProductDescription"></p>
                <form method="POST" class="modal-product-form">
                    <input type="hidden" name="product_id" id="modalProductId">
                    <div class="quantity-selector">
                        <button type="button" class="quantity-btn minus">-</button>
                        <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                        <button type="button" class="quantity-btn plus">+</button>
                    </div>
                    <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Add this CSS to your existing styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 30px;
    border-radius: 10px;
    width: 80%;
    max-width: 700px;
    position: relative;
    animation: modalopen 0.3s;
}

@keyframes modalopen {
    from {opacity: 0; transform: translateY(-50px);}
    to {opacity: 1; transform: translateY(0);}
}

.close-modal {
    position: absolute;
    right: 25px;
    top: 15px;
    font-size: 30px;
    color: #aaa;
    cursor: pointer;
}

.close-modal:hover {
    color: #333;
}

.modal-product {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 20px;
}

.modal-product-image {
    max-width: 300px;
    margin: 0 auto;
}

.modal-product-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
}

.modal-product-info {
    width: 100%;
    max-width: 500px;
}

.modal-product-info h2 {
    margin-bottom: 10px;
    color: #333;
}

.modal-product-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--primary);
    margin-bottom: 15px;
}

.modal-product-info p {
    margin-bottom: 20px;
    line-height: 1.6;
    color: #555;
}

.modal-product-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    width: 100%;
}

@media (max-width: 768px) {
    .modal-content {
        width: 90%;
        margin: 10% auto;
        padding: 20px;
    }
    
    .modal-product {
        flex-direction: column;
    }
    
    .modal-product-image {
        max-width: 200px;
    }
}
</style>

<script>
// Quantity selector functionality
document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.parentNode.querySelector('.quantity-input');
        let value = parseInt(input.value);
        
        if (this.classList.contains('minus')) {
            if (value > 1) {
                input.value = value - 1;
            }
        } else if (this.classList.contains('plus')) {
            input.value = value + 1;
        }
    });
});

// Quick View Modal
const modal = document.getElementById('quickViewModal');
const quickViewButtons = document.querySelectorAll('.quick-view');
const closeModal = document.querySelector('.close-modal');

quickViewButtons.forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        
        // Fetch product details (in a real app, you'd use AJAX)
        fetchProductDetails(productId).then(product => {
            document.getElementById('modalProductName').textContent = product.name;
            document.getElementById('modalProductPrice').textContent = '₱' + product.price.toFixed(2);
            document.getElementById('modalProductDescription').textContent = product.description || 'No description available';
            document.getElementById('modalProductId').value = product.id;
            
            const img = document.getElementById('modalProductImage');
            img.src = product.image || 'images/placeholder.jpg';
            img.alt = product.name;
            
            modal.style.display = 'block';
        });
    });
});

closeModal.addEventListener('click', function() {
    modal.style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Mock function to fetch product details - in a real app, you'd use AJAX
function fetchProductDetails(productId) {
    return new Promise((resolve) => {
        // This is just for demo - in a real app, you'd make an AJAX request to a PHP endpoint
        const products = <?php echo json_encode($products); ?>;
        const product = products.find(p => p.id == productId);
        resolve({
            ...product,
            price: parseFloat(product.price)
        });
    });
}
</script>

<?php include('footer.php'); ?>