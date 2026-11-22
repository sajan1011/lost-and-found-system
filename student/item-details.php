<?php

require "../includes/session-check.php";
require "../includes/db.php";

// Logged-in student's ID
$user_id = $_SESSION['user_id'];

// Get report ID from URL
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: my-reports.php");
    exit();
}

$item_id = (int) $_GET['id'];

// Fetch report belonging to this student
$sql = "SELECT * FROM items WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($result);

// Check whether report exists
if (!$item) {
    $_SESSION['error'] = "Report not found.";
    header("Location: my-reports.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details | KBC Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="layout">
        <?php include "sidebar.php"; ?>
        <main class="main">

            <!-- Page Header -->
            <div class="reports-header">
                <div>
                    <h1>Item Details</h1>
                    <p>View complete information about your reported item.</p>
                </div>
                <a href="my-reports.php" class="report-new-btn">
                    Back to My Reports
                </a>
            </div>
            <div class="details-container">

                <!-- Item Image -->
                <div class="details-image">
                    <?php
                    if (!empty($item['image'])) {
                        ?>

                        <img src="../<?= htmlspecialchars($item['image']) ?>"
                            alt="<?= htmlspecialchars($item['item_name']) ?>">
                    <?php } else {
                        ?>
                        <div class="placeholder-image">📦</div>
                    <?php } ?>
                </div>

                <!-- Item Information -->
                <div class="details-info">
                    <span class="report-type <?= $item['type'] ?>">
                        <?= strtoupper(htmlspecialchars($item['type'])) ?>
                    </span>

                    <h2>
                        <?= htmlspecialchars($item['item_name']) ?>
                    </h2>

                    <div class="details-row">
                        <strong>Category:</strong>
                        <span><?= htmlspecialchars($item['category']) ?></span>
                    </div>

                    <div class="details-row">
                        <strong>Location:</strong>
                        <span><?= htmlspecialchars($item['location']) ?></span>
                    </div>

                    <div class="details-row">
                        <strong>Date Reported:</strong>
                        <span><?= htmlspecialchars($item['date_reported']) ?></span>
                    </div>

                    <div class="details-row">
                        <strong>Status:</strong>
                        <span><?= htmlspecialchars(ucfirst($item['status'])) ?></span>
                    </div>

                    <div class="details-description">
                        <strong>Description</strong>
                        <p><?= nl2br(htmlspecialchars($item['description'])) ?></p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="report-actions">
                        <a href="edit-item.php?id=<?= (int) $item['id'] ?>" class="edit-btn">
                            Edit Report
                        </a>
                        <a href="my-reports.php" class="view-btn">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>