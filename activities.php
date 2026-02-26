<?php
require_once 'config/db.php';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

// Get total count
$stmt = $pdo->query("SELECT COUNT(*) FROM activities WHERE status = 'Published'");
$total_activities = $stmt->fetchColumn();
$total_pages = ceil($total_activities / $limit);

// Fetch activities
$stmt = $pdo->query("SELECT * FROM activities WHERE status = 'Published' ORDER BY activity_date DESC LIMIT $limit OFFSET $offset");
$activities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities - KolekBibo</title>
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
                    <li><a href="activities.php" class="active">Activities</a></li>
                    <li><a href="donate.php">Donate</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Page Title -->
    <section class="hero" style="padding: 60px 0;">
        <div class="container">
            <h1>Our Activities</h1>
            <p>Stay updated with the latest events and happenings</p>
        </div>
    </section>

    <!-- Activities Section -->
    <section class="section">
        <div class="container">
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
            
            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>"><i class="fas fa-chevron-left"></i></a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>"><i class="fas fa-chevron-right"></i></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php else: ?>
            <div class="no-results">
                <i class="fas fa-calendar-times"></i>
                <h3>No Activities Yet</h3>
                <p>Check back soon for upcoming activities and events.</p>
            </div>
            <?php endif; ?>
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
