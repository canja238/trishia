<?php 
$pageTitle = "Contact Us | Beauty Collection";
include('header.php');
?>

<div class="container contact-container">
    <div class="contact-header">
        <h1>Get In Touch</h1>
        <p>We'd love to hear from you! Whether you have a question about our products, need help with your order, or just want to share your beauty tips, our team is ready to help.</p>
    </div>
    
    <div class="contact-grid">
        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="process_contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
        
        <div class="contact-info">
            <h2>Contact Information</h2>
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h3>Visit Us</h3>
                    <p>MB Poblacion Lumayon 4, Cotabato City, Philippines</p>
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <h3>Call Us</h3>
                    <p>(064) 255-577</p>
                    <p>Mon-Fri: 9am-6pm</p>
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h3>Email Us</h3>
                    <p>beautycollection@gmail.com</p>
                    <p>We typically respond within 24 hours</p>
                </div>
            </div>
            
            <div class="social-links">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="contact-map">
        <h2>Our Location</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.123456789012!2d124.249572!3d7.215019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTInNTQuMSJOIDEyNMKwMTQnNTguNSJF!5e0!3m2!1sen!2sph!4v1620000000000!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    
    <div class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <h3 class="faq-question">What payment methods do you accept? <i class="fas fa-chevron-down"></i></h3>
                <div class="faq-answer">
                    <p>We accept all major credit cards (Visa, Mastercard, American Express), GCash, PayPal, and bank transfers. All payments are processed securely.</p>
                </div>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">What is your return policy? <i class="fas fa-chevron-down"></i></h3>
                <div class="faq-answer">
                    <p>We offer a 30-day return policy for unopened and unused products. Please contact our customer service to initiate a return.</p>
                </div>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">How long does shipping take? <i class="fas fa-chevron-down"></i></h3>
                <div class="faq-answer">
                    <p>For Metro Manila: 1-2 business days. For provincial areas: 3-5 business days. International shipping varies by destination.</p>
                </div>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Are your products cruelty-free? <i class="fas fa-chevron-down"></i></h3>
                <div class="faq-answer">
                    <p>We carry a selection of cruelty-free brands which are clearly marked on product pages. We're committed to expanding our cruelty-free offerings.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .contact-container {
        padding: 60px 0;
    }
    
    .contact-header {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 50px;
    }
    
    .contact-header h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--primary);
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 60px;
    }
    
    .contact-form {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .contact-form h2 {
        margin-bottom: 30px;
        font-size: 1.8rem;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: inherit;
    }
    
    .form-group textarea {
        min-height: 150px;
    }
    
    .btn-primary {
        background: var(--primary);
        color: white;
        padding: 12px 30px;
        border-radius: 5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .btn-primary:hover {
        background: var(--primary-dark);
    }
    
    .contact-info {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .contact-info h2 {
        margin-bottom: 30px;
        font-size: 1.8rem;
    }
    
    .info-item {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .info-item i {
        font-size: 1.5rem;
        color: var(--primary);
        margin-top: 5px;
    }
    
    .info-item h3 {
        margin-bottom: 5px;
        font-size: 1.2rem;
    }
    
    .social-links {
        margin-top: 40px;
    }
    
    .social-icons {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }
    
    .social-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #f5f5f5;
        border-radius: 50%;
        color: var(--dark);
        transition: var(--transition);
    }
    
    .social-icons a:hover {
        background: var(--primary);
        color: white;
    }
    
    .contact-map {
        margin-bottom: 60px;
    }
    
    .contact-map h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2rem;
    }
    
    .map-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .faq-section h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2rem;
    }
    
    .faq-grid {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .faq-item {
        margin-bottom: 15px;
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .faq-question {
        padding: 20px;
        background: #f9f9f9;
        margin: 0;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: var(--transition);
    }
    
    .faq-question:hover {
        background: #f0f0f0;
    }
    
    .faq-question i {
        transition: var(--transition);
    }
    
    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }
    
    .faq-answer {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    
    .faq-item.active .faq-answer {
        padding: 20px;
        max-height: 500px;
    }
    
    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    // FAQ toggle functionality
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const faqItem = question.parentElement;
            faqItem.classList.toggle('active');
            
            // Close other open FAQs
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== faqItem && item.classList.contains('active')) {
                    item.classList.remove('active');
                }
            });
        });
    });
</script>

<?php include('footer.php'); ?>