<?php require_once 'config/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - KolekBibo</title>
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
                    <li><a href="about.php" class="active">About</a></li>
                    <li><a href="activities.php">Activities</a></li>
                    <li><a href="donate.php">Donate</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Page Title -->
    <section class="hero" style="padding: 60px 0;">
        <div class="container">
            <h1>About Us</h1>
            <p>Learn more about KolekBibo</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h3>Who We Are</h3>
                    <p>Kolekbibo is a social enterprise based in North Siargao that brings together collaborative creators to support the health, wellness, and sustainable development of the community. We are committed to serving residents and visitors by providing nutritious food, creating livelihood opportunities, and building partnerships that promote compassion, care, and positive social impact.
                    </p>
                    
                    <h3 style="margin-top: 30px;">Our Mission:</h3>
                    <p></p>
                    <ul style="list-style: disc; margin-left: 20px; margin-top: 10px;">
                        <p></p>
                        <li>Support and improve the health and wellness for north Siargao residents and its visitors.
                        </li>
                        <li>Build and inspire a local and global community of collaboration, compassion, and care.</li>
                        <p></p>
                        <dl><b>Our Objectives:</b></dl>
                        <p></p>
                        <li>Provide healthy and nutritious meals to at-risk and vulnerable groups in north Siargao, encouraging vegetarian and plant based options.</li>
                        <li>Create and support sustainable livelihood opportunities for local residents, especially women.
</li>
                        <li>Operate give-back and volunteer programs that instill values of compassionate behavior and actions.</li>
                        <li>Partner with social and environmental focused groups, non-profits and NGOs that share similar goals.</li>
                        <li>Invest in Kolekbibo&#39s team members through education, training development, financial stability and planning.
</li>
                    </ul>
                    
                    <h3 style="margin-top: 30px;">Our Values</h3>
                    <p>We value compassion, collaboration, sustainability, empowerment, and integrity in everything we do. We believe in caring for people and the environment, working together as a community, supporting long-term sustainable solutions, uplifting local residents—especially women—and acting with honesty and purpose to create meaningful and lasting change.</p>
                </div>
                <div class="about-image">
                    <img src="images/about image2.png" alt="About KolekBibo">
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
