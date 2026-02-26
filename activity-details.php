<?php
require_once 'config/db.php';

// Get activity ID from URL
$activity_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch activity
$stmt = $pdo->prepare("SELECT * FROM activities WHERE id = ? AND status = 'Published'");
$stmt->execute([$activity_id]);
$activity = $stmt->fetch();

// If not found, show 404
if (!$activity) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Activity Not Found</h1>";
    echo "<p>The activity you're looking for doesn't exist or hasn't been published.</p>";
    echo "<a href='activities.php'>Go Back</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($activity['title']); ?> - KolekBibo</title>
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
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Activity Details -->
    <section class="section">
        <div class="container">
            <div class="activity-details">
                <div class="activity-details-image">
                    <?php if (!empty($activity['image'])): ?>
                    <img src="uploads/<?php echo $activity['image']; ?>" alt="<?php echo htmlspecialchars($activity['title']); ?>">
                    <?php else: ?>
                    <img src="images/about image.png" alt="Default Image">
                    <?php endif; ?>
                </div>
                <div class="activity-details-content">
                    <div class="activity-details-date">
                        <i class="fas fa-calendar"></i>
                        <?php echo date('F j, Y', strtotime($activity['activity_date'])); ?>
                    </div>
                    <h1 class="activity-details-title"><?php echo htmlspecialchars($activity['title']); ?></h1>
                    <div class="activity-details-text">
                        <p><?php echo nl2br(htmlspecialchars($activity['description'])); ?></p>
                    </div>
                    <div style="margin-top: 30px;">
                        <a href="activities.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Activities</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Activities -->
    <?php
    // Fetch related activities (excluding current)
    $stmt = $pdo->prepare("SELECT * FROM activities WHERE id != ? AND status = 'Published' ORDER BY activity_date DESC LIMIT 3");
    $stmt->execute([$activity_id]);
    $related = $stmt->fetchAll();
    
    if (count($related) > 0):
    ?>
    <section class="section" style="background: #fff;">
        <div class="container">
            <div class="section-title">
                <h2>Other Activities</h2>
                <div class="underline"></div>
            </div>
            <div class="activities-grid">
                <?php foreach ($related as $rel): ?>
                <div class="activity-card">
                    <div class="activity-card-image">
                        <?php if (!empty($rel['image'])): ?>
                        <img src="uploads/<?php echo $rel['image']; ?>" alt="<?php echo htmlspecialchars($rel['title']); ?>">
                        <?php else: ?>
                        <img src="images/about image.png" alt="Default Image">
                        <?php endif; ?>
                    </div>
                    <div class="activity-card-content">
                        <div class="activity-card-date">
                            <i class="fas fa-calendar"></i>
                            <?php echo date('F j, Y', strtotime($rel['activity_date'])); ?>
                        </div>
                        <h3 class="activity-card-title"><?php echo htmlspecialchars($rel['title']); ?></h3>
                        <div class="activity-card-footer">
                            <a href="activity-details.php?id=<?php echo $rel['id']; ?>" class="activity-card-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

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
