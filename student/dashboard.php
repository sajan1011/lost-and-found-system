<?php
$current_page = 'dashboard';
require "../includes/session-check.php";
require "../includes/db.php";

$user_id = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'];

$total_reports = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM items WHERE user_id = $user_id"))['total'];
$lost_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM items WHERE user_id = $user_id AND type = 'lost'"))['total'];
$found_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM items WHERE user_id = $user_id AND type = 'found'"))['total'];
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

        <?php include "sidebar.php"; ?>

        <div class="main">

            <div class="topbar">
                <h1 class="page-title" style="border:none; margin:0; padding:0;">Dashboard</h1>
                <div class="welcome">Welcome, <strong><?= htmlspecialchars($full_name) ?></strong></div>
            </div>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<p class="msg success">' . $_SESSION['success'] . '</p>';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['error'])) {
                echo '<p class="msg error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>




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