<?php
require_once '../config.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$pageTitle = "Manage Users | Beauty Collection";
include('../header.php');

// Handle user deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Don't allow deleting the admin account
    if ($id != 1) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: users.php');
    exit();
}

// Handle role change
if (isset($_GET['role']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $role = $_GET['role'];
    // Don't allow changing the admin account
    if ($id != 1) {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $id]);
    }
    header('Location: users.php');
    exit();
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll();
?>

<div class="admin-container">
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="users.php" class="active">Users</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="../index.php">Home</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Manage Users</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <?php if ($user['id'] == 1): ?>
                            Admin
                        <?php else: ?>
                            <select onchange="changeRole(this, <?php echo $user['id']; ?>)">
                                <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['id'] != 1): ?>
                            <a href="users.php?delete=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This cannot be undone.')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function changeRole(selectElement, userId) {
    const role = selectElement.value;
    window.location.href = `users.php?role=${role}&id=${userId}`;
}
</script>

<?php include('../footer.php'); ?>