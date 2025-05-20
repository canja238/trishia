<?php 
$pageTitle = "Beauty Collection - Premium Cosmetics & Skincare";
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #ff6b98;
            --primary-dark: #e84980;
            --secondary: #6b5fff;
            --dark: #2a2a2a;
            --light: #ffffff;
            --light-gray: #f9f9f9;
            --gray: #e0e0e0;
            --dark-gray: #777777;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #fff0f5 0%, #f8f4ff 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .hero-content {
            flex: 1;
            min-width: 300px;
            padding-right: 30px;
            animation: fadeInUp 1s ease;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--dark);
            line-height: 1.2;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-text {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: var(--dark-gray);
            max-width: 500px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            text-align: center;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: var(--light);
            border: 2px solid var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        
        .btn-outline:hover {
            background-color: var(--primary);
            color: var(--light);
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }
        
        .hero-image {
            flex: 1;
            min-width: 300px;
            position: relative;
            animation: fadeIn 1.5s ease;
        }
        
        .hero-image img {
            width: 100%;
            max-width: 600px;
            border-radius: 20px;

            transition: var(--transition);
        }
        
        .hero-image:hover img {
            transform: scale(1.02);
        }
        
        /* Features Section */
        .features {
            padding: 60px 0;
            background-color: var(--light);
        }
        
        .features .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            text-align: center;
        }
        
        .feature {
            padding: 30px 20px;
            border-radius: 15px;
            transition: var(--transition);
            background-color: var(--light-gray);
        }
        
        .feature:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
        }
        
        .feature i {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--primary);
        }
        
        .feature h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--dark);
        }
        
        .feature p {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }
        
        /* Section Header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        
        .section-header h2 {
            font-size: 2rem;
            color: var(--dark);
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
        }
        
        .view-all {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .view-all:hover {
            color: var(--primary-dark);
            transform: translateX(5px);
        }
        
        .view-all i {
            font-size: 0.8rem;
        }
        
        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background-color: var(--light);
            border-radius: 15px;
            overflow: hidden;
            transition: var(--transition);
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: var(--primary);
            color: var(--light);
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }
        
        .product-image {
            position: relative;
            overflow: hidden;
            height: 250px;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-actions {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 15px;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.9);
        }
        
        .product-card:hover .product-actions {
            bottom: 0;
        }
        
        .wishlist-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background-color: var(--light);
            color: var(--dark);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .wishlist-btn:hover {
            color: var(--primary);
            transform: scale(1.1);
        }
        
        .quick-view {
            padding: 8px 15px;
            border-radius: 50px;
            border: none;
            background-color: var(--dark);
            color: var(--light);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .quick-view:hover {
            background-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-title {
            font-size: 1rem;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 600;
        }
        
        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 15px;
            color: #ffc107;
        }
        
        .product-rating span {
            color: var(--dark-gray);
            font-size: 0.8rem;
        }
        
        .add-to-cart {
            width: 100%;
            padding: 10px;
            border-radius: 50px;
            border: none;
            background-color: var(--primary);
            color: var(--light);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .add-to-cart:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(255, 107, 152, 0.3);
        }
        
        /* Categories Section */
        .categories {
            padding: 80px 0;
            background-color: var(--light-gray);
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
        }
        
        .category-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            height: 200px;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
        }
        
        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .category-card:hover img {
            transform: scale(1.05);
        }
        
        .category-card h3 {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            margin: 0;
            color: var(--light);
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            font-size: 1.2rem;
            text-align: center;
        }
        
        /* Testimonials Section */
        .testimonials {
            padding: 80px 0;
            background-color: var(--light);
        }
        
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .testimonial-card {
            background-color: var(--light-gray);
            padding: 30px;
            border-radius: 15px;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
        }
        
        .testimonial-rating {
            color: #ffc107;
            margin-bottom: 20px;
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            color: var(--dark);
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .testimonial-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .testimonial-author h4 {
            font-size: 1rem;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .testimonial-author p {
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        /* Newsletter Section */
        .newsletter {
            padding: 80px 0;
            background: linear-gradient(135deg, #fff0f5 0%, #f8f4ff 100%);
            text-align: center;
        }
        
        .newsletter-content {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .newsletter h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .newsletter p {
            color: var(--dark-gray);
            margin-bottom: 30px;
        }
        
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .newsletter-form input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            border-radius: 50px 0 0 50px;
            font-size: 1rem;
            outline: none;
        }
        
        .newsletter-form button {
            padding: 15px 30px;
            border: none;
            border-radius: 0 50px 50px 0;
            background-color: var(--primary);
            color: var(--light);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .newsletter-form button:hover {
            background-color: var(--primary-dark);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero .container {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-content {
                padding-right: 0;
                margin-bottom: 40px;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-form input,
            .newsletter-form button {
                border-radius: 50px;
                width: 100%;
            }
            
            .newsletter-form button {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Glow With Confidence</h1>
                <p class="hero-text">Discover our premium cosmetics and skincare products carefully crafted to enhance your natural beauty and boost your confidence.</p>
                <div class="hero-buttons">
                    <a href="shop.php" class="btn btn-primary">Shop Now</a>

                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">10,000+</span>
                        <span class="stat-label">Happy Customers</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Authentic Products</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="logo.png" alt="Premium beauty products" loading="lazy">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="feature">
                <i class="fas fa-truck"></i>
                <h3>Free Shipping</h3>
                <p>On orders over ₱1,000</p>
            </div>
            <div class="feature">
                <i class="fas fa-undo"></i>
                <h3>Easy Returns</h3>
                <p>30-day hassle-free returns</p>
            </div>
            <div class="feature">
                <i class="fas fa-gem"></i>
                <h3>Premium Quality</h3>
                <p>100% authentic luxury brands</p>
            </div>
            <div class="feature">
                <i class="fas fa-headset"></i>
                <h3>24/7 Support</h3>
                <p>Dedicated beauty consultants</p>
            </div>
        </div>
    </section>



    <!-- Categories -->
    <section class="categories">
        <div class="container">
            <div class="section-header">
                <h2>Shop by Category</h2>
                <a href="categories.php" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="categories-grid">
                <a href="shop.php?category=Makeup" class="category-card">
                    <img src="makeup.png" alt="Makeup Collection" loading="lazy">
                    <h3>Makeup</h3>
                </a>
                <a href="shop.php?category=Skincare" class="category-card">
                    <img src="skincare.png" alt="Skincare Products" loading="lazy">
                    <h3>Skincare</h3>
                </a>
                <a href="shop.php?category=Hair Care" class="category-card">
                    <img src="haircare.png" alt="Hair Care Products" loading="lazy">
                    <h3>Hair Care</h3>
                </a>
                <a href="shop.php?category=Fragrance" class="category-card">
                    <img src="fragrance.png" alt="Luxury Fragrances" loading="lazy">
                    <h3>Fragrance</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
   

    <!-- Newsletter -->
    <section class="newsletter">
        <div class="container">
            <div class="newsletter-content">
                <h2>Join Our Beauty Community</h2>
                <p>Subscribe to get updates on new arrivals, exclusive offers, and beauty tips</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
                <p class="newsletter-note">By subscribing, you agree to our Privacy Policy and consent to receive updates from our company.</p>
            </div>
        </div>
    </section>

    <script>
        // Simple animation for elements when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.feature, .product-card, .testimonial-card, .category-card');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.3;
                    
                    if(elementPosition < screenPosition) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };
            
            // Set initial state for animated elements
            const animatedElements = document.querySelectorAll('.feature, .product-card, .testimonial-card, .category-card');
            animatedElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            });
            
            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll(); // Run once on load
        });
    </script>
</body>
</html>

<?php include('footer.php'); ?>