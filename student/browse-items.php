<?php
$current_page = 'browse';

require "../includes/session-check.php";
require "../includes/db.php";

$search = trim($_GET['search'] ?? '');
$category = trim($_GET['category'] ?? '');
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM items WHERE type = 'found' AND status = 'active' AND user_id != ?";
$params = [$user_id];
$types = "i";

if ($search !== "") {
$sql .= " AND (item_name LIKE ? OR category LIKE ?)"; 
   $search_value = "%$search%";
    $params[] = $search_value;
    $params[] = $search_value;
    $types .= "ss";
}

if ($category !== "") {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

$sql .= " ORDER BY id DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Items | KBC Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <div class="layout">
        <?php include "sidebar.php"; ?>
        <!-- Main Content -->
        <main class="main">
            <div class="topbar">
                <h1 class="page-title" style="border:none; margin:0; padding:0;">
                    Browse Found Items
                </h1>
            </div>

            <!-- Search and Filter -->
            <div class="browse-tools">

                <!-- Search -->
                <form method="GET" action="browse-item.php" class="small-search">
                    <input type="text" name="search" placeholder="Search items..."
                        value="<?= htmlspecialchars($search) ?>">
                    <button type="submit">🔍</button>
                </form>

                <!-- Filter -->
                <form method="GET" action="browse-item.php" class="small-filter">
                    <select name="category">
                        <option value="">All Categories</option>
                        <option value="Bag" <?= $category == 'Bag' ? 'selected' : '' ?>>Bag</option>
                        <option value="Phone" <?= $category == 'Phone' ? 'selected' : '' ?>>Phone</option>
                        <option value="ID Card" <?= $category == 'ID Card' ? 'selected' : '' ?>>ID Card</option>
                        <option value="Key" <?= $category == 'Key' ? 'selected' : '' ?>>Key</option>
                        <option value="Book" <?= $category == 'Book' ? 'selected' : '' ?>>Book</option>
                        <option value="Clothing" <?= $category == 'Clothing' ? 'selected' : '' ?>>Clothing</option>
                        <option value="Other" <?= $category == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                    <button type="submit">Filter</button>
                </form>
            </div>

            <!-- Items -->
            <h2 class="page-title">
                Available Found Items
            </h2>
            <div class="items-grid">

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($item = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="item-card">
                            <div class="item-image">
                                <?php
                                if (!empty($item['image'])) {
                                    ?>
                                    <img src="../<?= htmlspecialchars($item['image']) ?>"
                                        alt="<?= htmlspecialchars($item['item_name']) ?>">
                                    <?php
                                } else {
                                    ?>
                                    <div class="no-image">
                                        No Image
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="item-details">
                                <span class="item-status found">
                                    Found
                                </span>
                                <h3>
                                    <?= htmlspecialchars($item['item_name']) ?>
                                </h3>
                                <p>
                                    <strong>Category:</strong>
                                    <?= htmlspecialchars($item['category']) ?>
                                </p>
                              
                                <?php

                                if (!empty($item['location'])) {
                                    ?>
                                    <p>
                                        <strong>Location:</strong>
                                        <?= htmlspecialchars($item['location']) ?>
                                    </p>
                                    <?php
                                }
                                ?>
                                <?php
                                if (!empty($item['date_found'])) {
                                    ?>
                                    <p>
                                        <strong>Date Found:</strong>
                                        <?= htmlspecialchars($item['date_found']) ?>
                                    </p>
                                    <?php
                                }
                                ?>

                                <!-- Action Buttons -->
                                <div class="item-actions">
                                    <a href="item-details.php?id=<?= $item['id'] ?>" class="btn btn-primary">
                                        View Details
                                    </a>
                                    <a href="claim-item.php?id=<?= $item['id'] ?>" class="btn btn-claim">
                                        Claim Item
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="no-items">
                        <h3>
                            No found items available
                        </h3>
                        <p>
                            Try a different search or category.
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>
<?php

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>