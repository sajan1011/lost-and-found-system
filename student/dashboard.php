<?php
require "../includes/session-check.php";
require "../includes/db.php";

$user_id   = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'];

$total_reports = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM items WHERE user_id = $user_id"))['total'];
$lost_count    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM items WHERE user_id = $user_id AND type = 'lost'"))['total'];
$found_count   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM items WHERE user_id = $user_id AND type = 'found'"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | KBC Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="layout">

    <aside class="sidebar">
        <a href="dashboard.php" class="brand">
            KBC Lost & Found
            <span>Student Panel</span>
        </a>
        <nav>
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="report-item.php">Report Item</a>
            <a href="browse-items.php">Browse Items</a>
            <a href="my-reports.php">My Reports</a>
            <a href="my-claims.php">My Claims</a>
        </nav>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </aside>

    <div class="main">

        <div class="topbar">
            <h1 class="page-title" style="border:none; margin:0; padding:0;">Dashboard</h1>
            <div class="welcome">Welcome, <strong><?= htmlspecialchars($full_name) ?></strong></div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <p class="msg success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="msg error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <div class="summary-grid">
            <div class="summary-card">
                <h2><?= $total_reports ?></h2>
                <p>Total Reports</p>
            </div>
            <div class="summary-card">
                <h2><?= $lost_count ?></h2>
                <p>Lost Items Reported</p>
            </div>
            <div class="summary-card">
                <h2><?= $found_count ?></h2>
                <p>Found Items Reported</p>
            </div>
        </div>

        <h2 class="page-title">Quick Actions</h2>

        <div class="quick-actions">
            <a href="report-item.php" class="btn btn-danger">+ Report Lost Item</a>
            <a href="report-item.php" class="btn btn-success">+ Report Found Item</a>
            <a href="browse-items.php" class="btn btn-primary">Browse All Items</a>
            <a href="my-reports.php" class="btn btn-warning">My Reports</a>
        </div>

    </div>
</div>

</body>
</html>