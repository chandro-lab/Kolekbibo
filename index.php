<?php
require_once 'config/db.php';

// Fetch published activities for homepage
$stmt = $pdo->query("SELECT * FROM activities WHERE status = 'Published' ORDER BY activity_date DESC LIMIT 6");
$activities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KolekBibo - Activity Management System</title>
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
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="activities.php">Activities</a></li>
                    <li><a href="donate.php">Donate</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to KolekBibo</h1>
            <p>Stay updated with the latest activities and events</p>
            <a href="activities.php" class="btn">View Activities</a>
        </div>
    </section>

    <!-- Video Section -->
    <section class="section" style="background: #fff;">
        <div class="container">
            <div style="max-width: 3500px; margin: 0 auto;">
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <iframe 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
src="https://www.youtube.com/embed/nEI7hRZ1-hk?autoplay=1"
                        title="KolekBibo Video" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Activities Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Recent Activities</h2>
                <div class="underline"></div>
            </div>
            
            <?php if (count($activities) > 0): ?>
            <div class="activities-grid">
                <?php foreach ($activities as $activity): ?>
                <div class="activity-card">
                    <div class="activity-card-image">
                        <?php if (!empty($activity['image'])): ?>
                        <img src="uploads/<?php echo $activity['image']; ?>" alt="<?php echo htmlspecialchars($activity['title']); ?>">
                        <?php else: ?>
                        <img src="images/about image.png" alt="Default Image">
                        <?php endif; ?>
                    </div>
                    <div class="activity-card-content">
                        <div class="activity-card-date">
                            <i class="fas fa-calendar"></i>
                            <?php echo date('F j, Y', strtotime($activity['activity_date'])); ?>
                        </div>
                        <h3 class="activity-card-title"><?php echo htmlspecialchars($activity['title']); ?></h3>
                        <p class="activity-card-excerpt"><?php echo htmlspecialchars(substr($activity['description'], 0, 150)); ?>...</p>
                        <div class="activity-card-footer">
                            <a href="activity-details.php?id=<?php echo $activity['id']; ?>" class="activity-card-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <a href="activities.php" class="btn">View All Activities</a>
            </div>
            <?php else: ?>
            <div class="no-results">
                <i class="fas fa-calendar-times"></i>
                <h3>No Activities Yet</h3>
                <p>Check back soon for upcoming activities and events.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- About Preview Section -->
    <section class="section" style="background: #fff;">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h3>About KolekBibo</h3>
                    <p>We are dedicated to keeping you informed about the latest activities, events, and news. Our system ensures that all important updates are shared in real-time.</p>
                    <p>Explore our activities page to stay connected with what's happening in our community.</p>
                    <a href="about.php" class="btn">Learn More</a>
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
