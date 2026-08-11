<?php
require "../includes/session-check.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Item | KBC Lost & Found</title>
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
            <a href="dashboard.php">Dashboard</a>
            <a href="report-item.php" class="active">Report Item</a>
            <a href="browse-items.php">Browse Items</a>
            <a href="my-reports.php">My Reports</a>
            <a href="my-claims.php">My Claims</a>
        </nav>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </aside>

    <div class="main">

        <div class="topbar">
            <h1 class="page-title" style="border:none; margin:0; padding:0;">Report an Item</h1>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="msg error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <div class="form-box">
            <form action="report-handle.php" method="POST" enctype="multipart/form-data">

                <div class="input-group">
                    <label>Item Type</label>
                    <select name="type" required>
                        <option value="">-- Select Type --</option>
                        <option value="lost">Lost</option>
                        <option value="found">Found</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Item Title</label>
                    <input type="text" name="title" placeholder="e.g. Blue Water Bottle" required>
                </div>

                <div class="input-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="">-- Select Category --</option>
                        <option value="ID Card">ID Card</option>
                        <option value="Books / Notes">Books / Notes</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Phone">Phone</option>
                        <option value="Water Bottle">Water Bottle</option>
                        <option value="Keys">Keys</option>
                        <option value="Bag">Bag</option>
                        <option value="Wallet">Wallet</option>
                        <option value="Stationery">Stationery</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Location</label>
                    <select name="location" required>
                        <option value="">-- Select Location --</option>
                        <option value="Library">Library</option>
                        <option value="Canteen">Canteen</option>
                        <option value="Computer Lab">Computer Lab</option>
                        <option value="Classroom Block">Classroom Block</option>
                        <option value="Parking Area">Parking Area</option>
                        <option value="Sports Ground">Sports Ground</option>
                        <option value="Admin Block">Admin Block</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Date</label>
                    <input type="date" name="date_reported" max="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="input-group">
                    <label>Description</label>
                    <textarea name="description" placeholder="Describe the item in detail..." required></textarea>
                </div>

                <div class="input-group">
                    <label>Image (Optional)</label>
                    <input type="file" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; padding:12px; font-size:16px;">
                    Submit Report
                </button>

            </form>
        </div>

    </div>
</div>

</body>
</html>