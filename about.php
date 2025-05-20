<?php 
$pageTitle = "About Us | Beauty Collection";
include('header.php');
?>

<div class="container about-container">
    <section class="about-section">
        <h1>Our Story</h1>
        <div class="about-content">
            <div class="about-text">
                <p>Founded in 2020, Beauty Collection started as a small boutique in Cotabato City with a passion for bringing high-quality beauty products to our community. What began as a single store has now grown into a trusted online destination for beauty enthusiasts across the Philippines.</p>
                
                <p>Our mission is simple: to help you look and feel your best with carefully curated cosmetics and skincare products from around the world. We believe that beauty should be accessible, fun, and empowering for everyone.</p>
                
                <h2>Why Choose Us?</h2>
                <ul class="about-features">
                    <li><i class="fas fa-check-circle"></i> 100% authentic products with official distributor warranties</li>
                    <li><i class="fas fa-check-circle"></i> Expertly curated selection from global brands</li>
                    <li><i class="fas fa-check-circle"></i> Free beauty consultations with every purchase</li>
                    <li><i class="fas fa-check-circle"></i> Fast and reliable nationwide shipping</li>
                    <li><i class="fas fa-check-circle"></i> Responsive customer service team</li>
                </ul>
            </div>
            <div class="about-image">
                <img src="logo.png" alt="Our Beauty Store" loading="lazy">
            </div>
        </div>
    </section>


    <section class="values-section">
        <h2>Our Values</h2>
        <div class="values-grid">
            <div class="value-card">
                <i class="fas fa-heart"></i>
                <h3>Authenticity</h3>
                <p>We source directly from brands and authorized distributors to guarantee genuine products.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-star"></i>
                <h3>Quality</h3>
                <p>Every product in our collection is carefully tested and selected by our beauty experts.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-hand-holding-heart"></i>
                <h3>Community</h3>
                <p>We're committed to building a beauty community that celebrates all forms of beauty.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-leaf"></i>
                <h3>Sustainability</h3>
                <p>We actively seek out eco-friendly brands and packaging solutions.</p>
            </div>
        </div>
    </section>
</div>

<style>
    .about-container {
        padding: 60px 0;
    }
    
    .about-section h1 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.5rem;
        color: var(--primary);
    }
    
    .about-content {
        display: flex;
        gap: 40px;
        margin-bottom: 60px;
        align-items: center;
    }
    
    .about-text {
        flex: 1;
    }
    
    .about-text p {
        margin-bottom: 20px;
        line-height: 1.8;
    }
    
    .about-image {
        flex: 1;
    }
    
    .about-image img {
        width: 100%;
        border-radius: 10px;

    }
    
    .about-features {
        margin: 30px 0;
    }
    
    .about-features li {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .about-features i {
        color: var(--primary);
    }
    
    .team-section h2,
    .values-section h2 {
        text-align: center;
        margin: 60px 0 40px;
        font-size: 2rem;
    }
    
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .team-member {
        text-align: center;
        background: white;
        padding: 30px 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: var(--transition);
    }
    
    .team-member:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .team-member img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 20px;
        border: 3px solid var(--primary);
    }
    
    .team-member h3 {
        color: var(--dark);
        margin-bottom: 5px;
    }
    
    .team-member p {
        color: var(--gray);
    }
    
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .value-card {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: var(--transition);
    }
    
    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .value-card i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 20px;
    }
    
    .value-card h3 {
        margin-bottom: 15px;
    }
    
    @media (max-width: 768px) {
        .about-content {
            flex-direction: column;
        }
        
        .about-image {
            order: -1;
        }
    }
</style>

<?php include('footer.php'); ?>