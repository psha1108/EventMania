
<?php
// C:\xampp\htdocs\event-management\index.php
//localhost/event-management/index.php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventMania - Event Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">EventMania</div>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#packages">Packages</a></li>
                <li><a href="#reviews">Reviews</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li id="auth-link">
                    <?php if(isset($_SESSION['username'])): ?>
                        <a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a> | 
                        <a href="logout.php">Logout</a>
                    <?php else: ?>
                        <a href="login.php">Login/Register</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Hero Section with Slideshow -->
<!-- Hero Slideshow Section -->
<!-- WORKING Hero Slideshow -->
<section id="home" class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <?php if(isset($_SESSION['username'])): ?>
            <div class="welcome-message">
                <span><h2>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2></span>
            </div>
        <?php endif; ?>
        
        <h1>Your Dream Event Starts Here</h1>
        <p>Professional event management services tailored to your needs</p>
        
        <div class="hero-features">
            <div class="feature-item">
                <span class="feature-icon">🎯</span>
                <span>100+ Successful Events</span>
            </div>
            <div class="feature-item">
                <span class="feature-icon">⭐</span>
                <span>5-Star Rated Service</span>
            </div>
            <div class="feature-item">
                <span class="feature-icon">💼</span>
                <span>Corporate & Private</span>
            </div>
        </div>
    </div>
</section>

        <!-- Services Section -->
<section id="services" class="section">
    <div class="section-heading">
        <h2>Our Services</h2>
    </div>
    <div class="services-grid">
        <div class="service-card">
            <h3>Event Planning</h3>
            <p>Complete end-to-end event coordination</p>
            <div class="service-icon">🎯</div>
        </div>
        <div class="service-card">
            <h3>Decoration</h3>
            <p>Custom themes and designs</p>
            <div class="service-icon">🎨</div>
        </div>
        <div class="service-card">
            <h3>Catering</h3>
            <p>Gourmet food and beverage services</p>
            <div class="service-icon">🍽️</div>
        </div>
        <div class="service-card">
            <h3>Photography</h3>
            <p>Professional event coverage</p>
            <div class="service-icon">📷</div>
        </div>
    </div>
</section>
<!-- Packages Section -->
<section id="packages" class="section">
    <div class="section-heading">
        <h2>Our Packages</h2>
    </div>
    <div class="packages-grid">
        <?php
        require 'db.php';
        $result = $conn->query("SELECT * FROM packages LIMIT 3");
        while($package = $result->fetch_assoc()):
        ?>
        <div class="package-card">
            <h3><?php echo htmlspecialchars($package['name']); ?></h3>
            <p><?php echo htmlspecialchars($package['description']); ?></p>
            <div class="price">$<?php echo number_format($package['price'], 2); ?></div>
            <p><a href="payment.php?package=<?php echo $package['id']; ?>" class="btn btn-primary">Book Now</a>
            </p>
            
        </div>
        <?php endwhile; ?>
    </div>
</section>

<!-- New Reviews Section -->
<section id="reviews" class="section">
    <div class="section-heading">
        <h2>Customer Reviews</h2>
    </div>
    <div class="reviews-grid">
        <div class="review-card">
            <div class="reviewer-info">
                <div class="reviewer-name">Palak Sharma</div>
                <div class="stars">★★★★★</div>
            </div>
            <div class="review-text">
                "EventMania made my wedding dreams come true! Their attention to detail and professional service was beyond expectations. Everything was perfect!"
            </div>
        </div>
        <div class="review-card">
            <div class="reviewer-info">
                <div class="reviewer-name">Arpita Sonawane</div>
                <div class="stars">★★★★☆</div>
            </div>
            <div class="review-text">
                "Our corporate event was a huge success thanks to EventMania. The team was responsive and creative. The catering was exceptional!"
            </div>
        </div>
        <div class="review-card">
            <div class="reviewer-info">
                <div class="reviewer-name">Asavari Patil</div>
                <div class="stars">★★★★★</div>
            </div>
            <div class="review-text">
                "I've used EventMania for three events now, and they consistently deliver excellence. Their platinum package is worth every penny!"
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<!-- About Section -->
<section id="about" class="section">
    <div class="section-heading">
        <h2>About Us</h2>
    </div>
    
    <div class="about-content">
        <div class="about-text">
            <h3>EventMania <span>Where Dreams Become Unforgettable Events</span></h3>
            
            <p>At EventMania, we specialize in transforming visions into extraordinary experiences. 
            With a passionate team of creative planners and meticulous executors, we craft weddings, 
            corporate events, and celebrations that leave lasting impressions.</p>
            
            <div class="highlights">
                <h4>Our Work</h4>
                <p>From intimate gatherings to grand galas, we handle every detail:</p>
                <ul>
                    <li>🎯 <strong>Custom Planning</strong>: Tailored to your unique vision</li>
                    <li>✨ <strong>Stunning Decor</strong>: Themed designs that wow</li>
                    <li>🍽️ <strong>Gourmet Catering</strong>: Culinary excellence</li>
                    <li>📷 <strong>Professional Coverage</strong>: Capture every moment</li>
                </ul>
            </div>
            
            <blockquote>"Your event is our masterpiece – we don't just plan, we create magic."</blockquote>
            
            <div class="key-features">
                <p>✅ <strong>100+</strong> successful events</p>
                <p>✅ <strong>5-star</strong> client reviews</p>
                <p>✅ <strong>Stress-free</strong> planning</p>
            </div>
        </div>
        
        <div class="video-container">
            <h3>See Our Magic in Action</h3>
            <iframe 
                src="https://www.youtube.com/embed/0T-Np-hEL1Y?si=ZerTuqVpKaNuIZ8a&rel=0&modestbranding=1" 
                title="EventMania Team Highlights" 
                frameborder="0" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>
        <!-- Add this to your contact section in index.php -->
        <!-- Contact Section -->
        <!-- In your Contact section (index.php) -->
<!-- Contact Section -->
<!-- Contact Section -->
<section id="contact" class="section">
    <div class="section-heading">
        <h2>Contact Us</h2>
    </div>
    
    <div class="contact-content">
        <div class="contact-info">
            <h3>Get In Touch</h3>
            <p>If you're interested in planning an event, feel free to reach out to us!</p>
            <div class="contact-details">
                <p><span class="contact-icon">📧</span> Email: contact@eventmania.com</p>
                <p><span class="contact-icon">📞</span> Phone: 123-456-7890</p>
            </div>
        </div>
        
        <div class="visit-us">
            <h3>Visit Us</h3>
            <div class="map-card">
                <div class="map-embed">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3773.650657218559!2d73.11026231538295!3d18.990501359839365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7e9d6b4fef7e9%3A0x2a3a0f3e92f5b1a0!2sPillai%20College%20of%20Engineering!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin&z=16&output=embed&markers=color:red%7C18.990501,73.112451"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        aria-label="Pillai College Location">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>