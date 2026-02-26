<?php
require_once '../config/db.php';

// Check if admin is logged in
if (!isAdminLoggedIn()) {
    redirect('login.php');
}

// Get statistics
$stmt = $pdo->query("SELECT COUNT(*) FROM activities");
$total_activities = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM activities WHERE status = 'Published'");
$published = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM activities WHERE status = 'Draft'");
$drafts = $stmt->fetchColumn();

// Get recent activities
$stmt = $pdo->query("SELECT * FROM activities ORDER BY created_at DESC LIMIT 5");
$recent_activities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KolekBibo Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="logo">
                <img src="../images/Kolekbibo logo.jfif" alt="KolekBibo Logo" style="height: 40px; margin-right: 10px;">
                KolekBibo
            </div>
            <nav class="admin-nav">
                <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="manage-activities.php"><i class="fas fa-calendar"></i> Activities</a>
                <a href="add-activity.php"><i class="fas fa-plus"></i> Add Activity</a>
                <a href="../index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>!</p>
            </div>

            <!-- Stats -->
            <div class="admin-stats">
                <div class="stat-card">
                    <h3><?php echo $total_activities; ?></h3>
                    <p>Total Activities</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $published; ?></h3>
                    <p>Published</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $drafts; ?></h3>
                    <p>Drafts</p>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="data-table">
                <h3 style="padding: 20px; margin: 0; background: var(--primary-orange); color: #fff;">Recent Activities</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($recent_activities) > 0): ?>
                        <?php foreach ($recent_activities as $activity): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($activity['title']); ?></td>
                            <td><?php echo date('M j, Y', strtotime($activity['activity_date'])); ?></td>
                            <td>
                                <span class="status-<?php echo strtolower($activity['status']); ?>">
                                    <?php echo $activity['status']; ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($activity['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">No activities yet</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="../js/main.js"></script>
</body>
</html>
