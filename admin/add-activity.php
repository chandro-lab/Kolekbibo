<?php
require_once '../config/db.php';

// Check if admin is logged in
if (!isAdminLoggedIn()) {
    redirect('login.php');
}

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitize($_POST['title']);
    $description = $_POST['description'];
    $activity_date = $_POST['activity_date'];
    $status = $_POST['status'];
    
    // Validate input
    if (empty($title) || empty($description) || empty($activity_date)) {
        $error = 'Please fill in all required fields.';
    } else {
        // Handle image upload
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed)) {
                $new_filename = time() . '_' . basename($filename);
                $upload_dir = '../uploads/';
                
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_filename)) {
                    $image = $new_filename;
                } else {
                    $error = 'Failed to upload image.';
                }
            } else {
                $error = 'Invalid image format. Allowed: jpg, jpeg, png, gif.';
            }
        }
        
        if (empty($error)) {
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO activities (title, description, image, activity_date, status) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$title, $description, $image, $activity_date, $status])) {
                $success = 'Activity added successfully!';
            } else {
                $error = 'Failed to add activity. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Activity - KolekBibo Admin</title>
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
                <a href="manage-activities.php"><i class="fas fa-calendar"></i> Activities</a>
                <a href="add-activity.php" class="active"><i class="fas fa-plus"></i> Add Activity</a>
                <a href="../index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>Add New Activity</h1>
            </div>

            <!-- Messages -->
            <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <!-- Add Form -->
            <div class="data-table" style="max-width: 800px;">
                <form action="" method="POST" enctype="multipart/form-data" style="padding: 30px;">
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description *</label>
                        <textarea id="description" name="description" rows="8" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="activity_date">Activity Date *</label>
                        <input type="date" id="activity_date" name="activity_date" required data-allow-past>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <small style="color: var(--medium-gray);">Allowed formats: jpg, jpeg, png, gif</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="Published">Published</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn">Add Activity</button>
                        <a href="manage-activities.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../js/main.js"></script>
</body>
</html>
