<?php

require "../includes/session-check.php";
require "../includes/db.php";

$current_page = "my-reports";
$user_id = $_SESSION['user_id'];

// Summary counts
$count_sql = "
    SELECT
        COUNT(*) AS total,
        COALESCE(SUM(type = 'lost'), 0) AS lost,
        COALESCE(SUM(type = 'found'), 0) AS found
    FROM items
    WHERE user_id = ?
";

$count_stmt = mysqli_prepare($conn, $count_sql);
mysqli_stmt_bind_param($count_stmt, "i", $user_id);
mysqli_stmt_execute($count_stmt);

$count_result = mysqli_stmt_get_result($count_stmt);
$counts = mysqli_fetch_assoc($count_result);

// Fetch student's reports
$sql = "SELECT * FROM items WHERE user_id = ? ORDER BY id DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reports | KBC Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="layout">
        <?php include "sidebar.php"; ?>
        <main class="main">

            <!-- Page Header -->
            <div class="reports-header">
                <div>
                    <h1>My Reports</h1>
                    <p>Manage the items you have reported.</p>
                </div>
                <a href="report-item.php" class="report-new-btn"> + Report Item</a>
            </div>

            <!-- Summary Cards -->
            <div class="report-summary">
                <div class="report-stat">
                    <div class="stat-icon lost-icon">L</div>
                    <div>
                        <h3><?= $counts['lost'] ?></h3>
                        <p>Lost Reports</p>
                    </div>
                </div>

                <div class="report-stat">
                    <div class="stat-icon found-icon">F</div>
                    <div>
                        <h3><?= $counts['found'] ?></h3>
                        <p>Found Reports</p>
                    </div>
                </div>

                <div class="report-stat">
                    <div class="stat-icon active-icon">✓</div>
                    <div>
                        <h3><?= $counts['total'] ?></h3>
                        <p>Your Reports</p>
                    </div>
                </div>

            </div>

            <!-- Reports Heading -->
            <div class="reports-section-header">
                <div>
                    <h2>Your Reports</h2>
                    <span><?= $counts['total'] ?> reports found</span>
                </div>
            </div>

            <!-- Reports List -->
            <div class="reports-list">
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($item = mysqli_fetch_assoc($result)) { ?>
                        <div class="report-card">

                            <!-- Item Image -->
                            <div class="report-image">
                                <?php if (!empty($item['image'])) { ?>
                                    <img src="../<?= htmlspecialchars($item['image']) ?>"
                                        alt="<?= htmlspecialchars($item['item_name']) ?>">

                                <?php } else { ?>
                                    <div class="placeholder-image">📦</div>
                                <?php } ?>
                            </div>

                            <!-- Item Information -->
                            <div class="report-info">
                                <div class="report-title-row">
                                    <div>
                                        <span class="report-type <?= $item['type'] == 'lost' ? 'lost' : 'found' ?>">
                                            <?= strtoupper(htmlspecialchars($item['type'])) ?>
                                        </span>
                                        <h3>
                                            <?= htmlspecialchars($item['item_name']) ?>
                                        </h3>
                                    </div>
                                </div>

                                <!-- Item Details -->
                                <div class="report-details">
                                    <span>
                                        📁 <?= htmlspecialchars($item['category']) ?>
                                    </span>
                                    <?php 
                                    if (!empty($item['location'])) { ?>
                                        <span>
                                            📍 <?= htmlspecialchars($item['location']) ?>
                                        </span>
                                    <?php } ?>

                                    <span>
                                        📅
                                        <?php
                                        if ($item['type'] == 'lost') {
                                            echo htmlspecialchars($item['date_lost'] ?? '');
                                        } else {
                                            echo htmlspecialchars($item['date_found'] ?? '');
                                        }
                                        ?>
                                    </span>

                                </div>

                                <!-- Description -->
                                <p class="report-description">
                                    <?= htmlspecialchars($item['description'] ?? '') ?>
                                </p>

                                <!-- Actions -->
                                <div class="report-actions">

                                    <a href="item-details.php?id=<?= (int) $item['id'] ?>" class="view-btn">
                                        View Details
                                    </a>

                                    <a href="edit-item.php?id=<?= (int) $item['id'] ?>" class="edit-btn">
                                        Edit
                                    </a>

                                    <a href="delete-item.php?id=<?= (int) $item['id'] ?>" class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this report?');">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="no-items">
                        <h3>No reports found</h3>
                        <p>You have not reported any items yet.</p>
                        <a href="report-item.php" class="report-new-btn">
                            + Report Your First Item
                        </a>
                    </div>
                <?php } ?>
            </div>
        </main>
    </div>
</body>

</html>