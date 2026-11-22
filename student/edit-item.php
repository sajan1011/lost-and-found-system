<?php

require "../includes/session-check.php";
require "../includes/db.php";

$user_id = $_SESSION['user_id'];

// Check whether item ID is provided
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: my-reports.php");
    exit();
}

$item_id = (int) $_GET['id'];

// Fetch the selected report belonging to the logged-in student
$sql = "SELECT * FROM items WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($result);

// Check whether the report exists
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
    <title>Edit Report | KBC Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include "sidebar.php"; ?>

    <div class="main-content">
        <div class="edit-report-container">
            <h2>Edit Report</h2>
            <form class="edit-report-form" action="edit-handle.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">

                <label>Item Name</label>
                <input type="text" name="item_name" value="<?= htmlspecialchars($item['item_name']) ?>" required>

                <label>Report Type</label>
                <select name="type" required>
                    <option value="lost" <?= $item['type'] == 'lost' ? 'selected' : '' ?>>Lost</option>
                    <option value="found" <?= $item['type'] == 'found' ? 'selected' : '' ?>>Found</option>
                </select>

                <label>Category</label>
                <input type="text" name="category" value="<?= htmlspecialchars($item['category']) ?>" required>

                <label>Location</label>
                <input type="text" name="location" value="<?= htmlspecialchars($item['location']) ?>" required>

                <label>Date Reported</label>
                <input type="date" name="date_reported" value="<?= htmlspecialchars($item['date_reported']) ?>"
                    required>

                <label>Description</label>
                <textarea name="description" required><?= htmlspecialchars($item['description']) ?></textarea>

                <label>Current Image</label>

                <?php
                if (!empty($item['image'])) {
                    ?>
                    <img class="edit-current-image" src="../<?= htmlspecialchars($item['image']) ?>"
                        alt="<?= htmlspecialchars($item['item_name']) ?>">
                    <?php
                } else {
                    ?>
                    <p>No image uploaded.</p>
                    <?php
                }
                ?>

                <label>Upload New Image (Optional)</label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp">

                <div class="edit-report-actions">
                    <button type="submit" name="update_item">Update Report</button>
                    <a href="my-reports.php">Cancel</a>
                </div>
            </form>
        </div>
</body>

</html>