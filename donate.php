<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - KolekBibo</title>
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
                    <li><a href="donate.php" class="active">Donate</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Page Title -->
    <section class="hero" style="padding: 60px 0;">
        <div class="container">
            <h1>Support Our Cause</h1>
            <p>Your generosity makes a difference</p>
        </div>
    </section>

    <!-- Donate Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Make a Donation</h2>
                <div class="underline"></div>
            </div>
            
            <div style="max-width: 900px; margin: 0 auto;">
                <p style="text-align: center; margin-bottom: 30px; font-size: 18px; color: var(--medium-gray);">
                    Your support helps us run programs and organize activities for the community. 
                    Any contribution — big or small — goes directly to supporting events, materials, and outreach.
                </p>
                
                <!-- Donation Images -->
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-bottom: 40px;">
                    <img src="images/donation image 1.png" alt="Donation Option 1" style="width: 280px; height: 350px; object-fit: cover; border-radius: 10px; box-shadow: var(--shadow);">
                    <img src="images/donation image 2.jpeg" alt="Donation Option 2" style="width: 280px; height: 350px; object-fit: cover; border-radius: 10px; box-shadow: var(--shadow);">
                    <img src="images/donation image 3.jpeg" alt="Donation Option 3" style="width: 280px; height: 350px; object-fit: cover; border-radius: 10px; box-shadow: var(--shadow);">
                </div>
                
                <div style="background: var(--white); padding: 30px; border-radius: 10px; box-shadow: var(--shadow); text-align: center;">
                    <h3 style="margin-bottom: 20px; color: var(--primary-orange);">Contact Us to Donate</h3>
                    <p style="margin-bottom: 30px; color: var(--medium-gray);">
                        Reach out to us through any of these channels to make your donation:
                    </p>
                    
                    <div style="display: flex; gap: 30px; justify-content: center; flex-wrap: wrap;">
                        <a href="mailto:donate@kolekbibo.com" style="color: var(--primary-orange); text-decoration: none; font-size: 18px; display: flex; align-items: center; gap: 10px; padding: 15px 25px; background: var(--pale-orange); border-radius: 8px;">
                            <i class="fas fa-envelope"></i>
                            <span>Email</span>
                        </a>
                        <a href="https://www.instagram.com/kolekbibo" target="_blank" rel="noopener" style="color: var(--primary-orange); text-decoration: none; font-size: 18px; display: flex; align-items: center; gap: 10px; padding: 15px 25px; background: var(--pale-orange); border-radius: 8px;">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100080806620630" target="_blank" rel="noopener" style="color: var(--primary-orange); text-decoration: none; font-size: 18px; display: flex; align-items: center; gap: 10px; padding: 15px 25px; background: var(--pale-orange); border-radius: 8px;">
                            <i class="fab fa-facebook"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="tel:+63 908 391 6901" style="color: var(--primary-orange); text-decoration: none; font-size: 18px; display: flex; align-items: center; gap: 10px; padding: 15px 25px; background: var(--pale-orange); border-radius: 8px;">
                            <i class="fas fa-phone"></i>
                            <span>+63 908 391 6901</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="section" style="background: #fff;">
        <div class="container">
            <div class="section-title">
                <h2>Your Impact</h2>
                <div class="underline"></div>
            </div>
            
            <div class="activities-grid">
                <div class="activity-card" style="text-align: center;">
                    <div class="activity-card-content">
                        <i class="fas fa-users" style="font-size: 40px; color: var(--primary-orange); margin-bottom: 15px;"></i>
                        <h3 class="activity-card-title">Community Events</h3>
                        <p class="activity-card-excerpt">Help us organize events that bring people together.</p>
                    </div>
                </div>
                
                <div class="activity-card" style="text-align: center;">
                    <div class="activity-card-content">
                        <i class="fas fa-book" style="font-size: 40px; color: var(--primary-orange); margin-bottom: 15px;"></i>
                        <h3 class="activity-card-title">Educational Materials</h3>
                        <p class="activity-card-excerpt">Support the creation of learning resources for all ages.</p>
                    </div>
                </div>
                
                <div class="activity-card" style="text-align: center;">
                    <div class="activity-card-content">
                        <i class="fas fa-hands-helping" style="font-size: 40px; color: var(--primary-orange); margin-bottom: 15px;"></i>
                        <h3 class="activity-card-title">Outreach Programs</h3>
                        <p class="activity-card-excerpt">Help us reach those who need support the most.</p>
                    </div>
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
