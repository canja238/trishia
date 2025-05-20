<?php
// footer.php
?>
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <h3 class="footer-title">Beauty Collection</h3>
          <p class="footer-about">Premium cosmetics and skincare products to help you glow with confidence.</p>
          <div class="footer-social">
            <a aria-label="Facebook" href="https://facebook.com" target="_blank">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a aria-label="Instagram" href="https://instagram.com" target="_blank">
              <i class="fab fa-instagram"></i>
            </a>
            <a aria-label="YouTube" href="https://youtube.com" target="_blank">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
        
        <div class="footer-col">
          <h3 class="footer-title">Quick Links</h3>
          <ul class="footer-links">
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="faq.php">FAQs</a></li>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms & Conditions</a></li>
          </ul>
        </div>
        
        <div class="footer-col">
          <h3 class="footer-title">Contact Info</h3>
          <div class="footer-contact">
            <div class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <address>MB Poblacion Lumayon 4, Cotabato City, Philippines</address>
            </div>
            <div class="contact-item">
              <i class="fas fa-envelope"></i>
              <a href="mailto:beautycollection@gmail.com">beautycollection@gmail.com</a>
            </div>
            <div class="contact-item">
              <i class="fas fa-phone-alt"></i>
              <a href="tel:+6464255577">(064) 255-577</a>
            </div>
          </div>
        </div>
        
        <div class="footer-col">
          <h3 class="footer-title">Newsletter</h3>
          <p>Subscribe to get updates on new arrivals and special offers.</p>
          <form class="newsletter-form">
            <input type="email" placeholder="Your email address" required>
            <button type="submit">Subscribe</button>
          </form>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Beauty Collection. All Rights Reserved.</p>
      </div>
    </div>
  </footer>
  
  <script src="script.js"></script>
  </body>
</html>