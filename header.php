<?php
// header.php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Beauty Collection - Premium cosmetics and skincare products">
  <title><?php echo $pageTitle; ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Playfair+Display:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Top bar -->
  <div class="top-bar">
    <div class="container">
      <span>✨ Enjoy Free Shipping For All Orders Over ₱1,000!</span>
    </div>
  </div>
  
  <!-- Header -->
  <header class="header">
    <div class="container">
      <a href="index.php" class="logo-container">
        <img alt="Beauty Collection Logo" class="logo-img" src="logo.png" width="40" height="40">
        <div class="logo-text">
          <div class="logo-main">BEAUTY</div>
          <div class="logo-sub">COLLECTION</div>
        </div>
      </a>
      
      <nav class="desktop-nav" id="nav-links">
      <a href="index.php" class="nav-link">HOME</a>
        <a href="shop.php" class="nav-link">SHOP</a>
        <a href="about.php" class="nav-link">ABOUT US</a>
        <a href="contact.php" class="nav-link">CONTACT</a>
        
        <?php if (isLoggedIn()): ?>
          <div class="nav-dropdown">
            <a href="account.php" class="nav-link">
              <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>
            <div class="dropdown-menu">
              <a href="account.php">My Account</a>
              <?php if (isAdmin()): ?>
                <a href="admin/dashboard.php">Admin Panel</a>
              <?php endif; ?>
              <a href="logout.php">Logout</a>
            </div>
          </div>
        <?php else: ?>
          <a href="login.php" class="nav-link"><i class="fas fa-user"></i> LOGIN</a>
        <?php endif; ?>
        
        <a href="cart.php" class="nav-link cart-link">
          <i class="fas fa-shopping-bag"></i>
          <span class="cart-count">
            <?php
            if (isLoggedIn()) {
              $stmt = $pdo->prepare("SELECT SUM(quantity) FROM cart WHERE user_id = ?");
              $stmt->execute([$_SESSION['user_id']]);
              $count = $stmt->fetchColumn();
              echo $count ? $count : '0';
            } else {
              echo '0';
            }
            ?>
          </span>
        </a>
      </nav>
      
      <div class="mobile-menu-btn">
        <button aria-label="Menu" class="menu-btn" id="menu-btn">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>
  
  <!-- Mobile menu -->
  <nav class="mobile-menu" id="mobile-menu">
    <div class="container">
      <a href="bestsellers.php" class="mobile-link">BEST SELLERS</a>
      <a href="categories.php" class="mobile-link">CATEGORIES</a>
      <a href="shop.php" class="mobile-link">SHOP</a>
      <a href="about.php" class="mobile-link">ABOUT US</a>
      <a href="contact.php" class="mobile-link">CONTACT</a>
      <?php if (isLoggedIn()): ?>
        <a href="account.php" class="mobile-link">MY ACCOUNT</a>
        <?php if (isAdmin()): ?>
          <a href="admin/dashboard.php" class="mobile-link">ADMIN PANEL</a>
        <?php endif; ?>
        <a href="logout.php" class="mobile-link">LOGOUT</a>
      <?php else: ?>
        <a href="login.php" class="mobile-link">LOGIN</a>
        <a href="register.php" class="mobile-link">REGISTER</a>
      <?php endif; ?>
    </div>
  </nav>

  <!-- Add this to your styles.css -->
  <style>
    /* Dropdown Styles */
    .nav-dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-arrow {
      font-size: 12px;
      margin-left: 5px;
      transition: var(--transition);
    }
    
    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background: var(--white);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-radius: 4px;
      padding: 10px 0;
      min-width: 180px;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      transition: var(--transition);
    }
    
    .nav-dropdown:hover .dropdown-menu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .nav-dropdown:hover .dropdown-arrow {
      transform: rotate(180deg);
    }
    
    .dropdown-menu a {
      display: block;
      padding: 8px 20px;
      color: var(--dark);
      font-size: 14px;
    }
    
    .dropdown-menu a:hover {
      background: var(--light);
      color: var(--primary);
    }
    
    /* Mobile menu account styles */
    .mobile-menu .mobile-link {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .mobile-menu .mobile-link i {
      width: 20px;
      text-align: center;
    }
  </style>