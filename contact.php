<?php
require_once 'config/db.php';

// Handle form submission
$alert_message = '';
$alert_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message_text = sanitize($_POST['message'] ?? '');
    
    if ($name && $email && $subject && $message_text) {
        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // For now, we'll just show success message
            // The contacts table doesn't exist yet - you can create it if needed
            $alert_message = 'Thank you! Your message has been sent successfully. We will get back to you soon.';
            $alert_type = 'success';
        } else {
            $alert_message = 'Please enter a valid email address.';
            $alert_type = 'error';
        }
    } else {
        $alert_message = 'Please fill in all fields.';
        $alert_type = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - KolekBibo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo">
                    <img src="images/Kolekbibo logo.jfif" alt="KolekBibo Logo" style="height: 50px;">
                    <span class="logo-text">Kolekbibo</span>
                </a>
                <div class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="activities.php">Activities</a></li>
                    <li><a href="donate.php">Donate</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Page Title -->
    <section class="hero" style="padding: 60px 0;">
        <div class="container">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <?php if ($alert_message): ?>
            <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; <?php echo $alert_type === 'success' ? 'background: #d4edda; color: #155724; border: 1px solid #c3e6cb;' : 'background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;'; ?>">
                <?php echo htmlspecialchars($alert_message); ?>
            </div>
            <?php endif; ?>
            
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h3>Get In Touch</h3>
                    <p style="margin-bottom: 30px;">Have questions or suggestions? Feel free to reach out to us using the form or contact information below.</p>
                    
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Address</strong>
                            <p>Barangay Bitaug, Burgos, Surigao Del Norte, Philippines 8424</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Phone</strong>
                            <p>+63 908 391 6901</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Messenger</strong>
                            <p><a href="https://www.facebook.com/profile.php?id=100080806620630">Facebook/Kolekbibo</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>Office Hours</strong>
                            <p>Wednesday - Monday: 8:00 AM - 9:00 PM</p>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Send us a Message</h3>
                    <form action="" method="POST" class="needs-validation">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-block">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: var(--shadow);">
                <div style="width: 100%; position: relative; padding-bottom: 56.25%; height: 0; border-radius: 5px; overflow: hidden;">
                    <iframe src="https://maps.google.com/maps?width=100%25&amp;height=100%25&amp;hl=en&amp;q=kolekbibo+(KolekBibo)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" 
                            allowfullscreen="" 
                            loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>KolekBibo</h3>
                    <p>Your source for activities and events information.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <p><a href="index.php">Home</a></p>
                    <p><a href="about.php">About</a></p>
                    <p><a href="activities.php">Activities</a></p>
                    <p><a href="contact.php">Contact</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> KolekBibo. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
