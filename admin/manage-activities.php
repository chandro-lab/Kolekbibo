<?php
require_once '../config/db.php';

// Check if admin is logged in
if (!isAdminLoggedIn()) {
    redirect('login.php');
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // First get the image filename
    $stmt = $pdo->prepare("SELECT image FROM activities WHERE id = ?");
    $stmt->execute([$id]);
    $activity = $stmt->fetch();
    
    // Delete image file from uploads folder if exists
    if ($activity && !empty($activity['image'])) {
        $image_path = '../uploads/' . $activity['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    
    // Delete from database
    $stmt = $pdo->prepare("DELETE FROM activities WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: manage-activities.php?success=deleted");
    exit;
}

// Handle toggle status request
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $stmt = $pdo->prepare("SELECT status FROM activities WHERE id = ?");
    $stmt->execute([$id]);
    $current = $stmt->fetch();
    $new_status = ($current['status'] == 'Published') ? 'Draft' : 'Published';
    $stmt = $pdo->prepare("UPDATE activities SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $id]);
    header("Location: manage-activities.php?success=status_changed");
    exit;
}

// Fetch all activities
$stmt = $pdo->query("SELECT * FROM activities ORDER BY created_at DESC");
$activities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Activities - KolekBibo Admin</title>
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
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="manage-activities.php" class="active"><i class="fas fa-calendar"></i> Activities</a>
                <a href="add-activity.php"><i class="fas fa-plus"></i> Add Activity</a>
                <a href="../index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>Manage Activities</h1>
                <a href="add-activity.php" class="btn"><i class="fas fa-plus"></i> Add New Activity</a>
            </div>

            <!-- Messages -->
            <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                    if ($_GET['success'] == 'deleted') echo 'Activity and associated image deleted successfully!';
                    elseif ($_GET['success'] == 'status_changed') echo 'Status updated successfully!';
                ?>
            </div>
            <?php endif; ?>

            <!-- Activities Table -->
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($activities) > 0): ?>
                        <?php foreach ($activities as $activity): ?>
                        <tr>
                            <td><?php echo $activity['id']; ?></td>
                            <td><?php echo htmlspecialchars($activity['title']); ?></td>
                            <td>
                                <?php if (!empty($activity['image'])): ?>
                                <img src="../uploads/<?php echo htmlspecialchars($activity['image']); ?>" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <?php else: ?>
                                <span style="color: #999;">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($activity['activity_date'])); ?></td>
                            <td>
                                <span class="status-<?php echo strtolower($activity['status']); ?>">
                                    <?php echo $activity['status']; ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($activity['created_at'])); ?></td>
                            <td>
                                <a href="edit-activity.php?id=<?php echo $activity['id']; ?>" class="btn btn-small" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="?toggle=<?php echo $activity['id']; ?>" class="btn btn-small btn-secondary btn-publish" data-status="<?php echo $activity['status']; ?>" title="<?php echo $activity['status'] == 'Published' ? 'Unpublish' : 'Publish'; ?>">
                                    <i class="fas fa-<?php echo $activity['status'] == 'Published' ? 'eye-slash' : 'eye'; ?>"></i>
                                </a>
                                <a href="?delete=<?php echo $activity['id']; ?>" class="btn btn-small btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">No activities yet. <a href="add-activity.php">Add your first activity!</a></td>
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
