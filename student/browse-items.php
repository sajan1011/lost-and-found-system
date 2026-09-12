<?php

require "../includes/session-check.php";
require "../includes/db.php";

$search = trim($_GET['search'] ?? '');
$category = trim($_GET['category'] ?? '');

$sql = "SELECT * FROM items WHERE type = 'found'";

$params = [];
$types = "";

if ($search !== "") {
    $sql .= " AND (item_name LIKE ? OR category LIKE ? OR color LIKE ?)";
    $search_value = "%$search%";

    $params[] = $search_value;
    $params[] = $search_value;
    $params[] = $search_value;

    $types .= "sss";
}

if ($category !== "") {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

$sql .= " ORDER BY id DESC";

$stmt = mysqli_prepare($conn, $sql);

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

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

    <!-- Sidebar -->

    <aside class="sidebar">

        <a href="dashboard.php" class="brand">
            KBC Lost & Found
            <span>Student Panel</span>
        </a>

        <nav>

            <a href="dashboard.php">
                Dashboard
            </a>

            <a href="report-item.php">
                Report Item
            </a>

            <a href="browse-items.php" class="active">
                Browse Items
            </a>

            <a href="my-reports.php">
                My Reports
            </a>

            <a href="my-claims.php">
                My Claims
            </a>

        </nav>

        <a href="../logout.php" class="logout-btn">
            Logout
        </a>

    </aside>


    <!-- Main Content -->

    <main class="main">

        <div class="topbar">

            <h1 class="page-title"
                style="border:none; margin:0; padding:0;">

                Browse Found Items

            </h1>

            <div class="welcome">

                Find your lost belongings

            </div>

        </div>


        <!-- Search -->

        <section class="browse-controls">

            <form method="GET" action="browse-items.php">

                <div class="search-box">

                    <input
                        type="text"
                        name="search"
                        placeholder="Search item name, category or color..."
                        value="<?= htmlspecialchars($search) ?>"
                    >

                    <button type="submit"
                            class="btn btn-primary">

                        Search

                    </button>

                </div>


                <div class="filter-box">

                    <select name="category">

                        <option value="">
                            All Categories
                        </option>

                        <option value="Bag"
                            <?= $category == "Bag" ? "selected" : "" ?>>
                            Bag
                        </option>

                        <option value="Phone"
                            <?= $category == "Phone" ? "selected" : "" ?>>
                            Phone
                        </option>

                        <option value="ID Card"
                            <?= $category == "ID Card" ? "selected" : "" ?>>
                            ID Card
                        </option>

                        <option value="Key"
                            <?= $category == "Key" ? "selected" : "" ?>>
                            Key
                        </option>

                        <option value="Book"
                            <?= $category == "Book" ? "selected" : "" ?>>
                            Book
                        </option>

                        <option value="Clothing"
                            <?= $category == "Clothing" ? "selected" : "" ?>>
                            Clothing
                        </option>

                        <option value="Other"
                            <?= $category == "Other" ? "selected" : "" ?>>
                            Other
                        </option>

                    </select>

                    <button type="submit"
                            class="btn btn-primary">

                        Filter

                    </button>

                </div>

            </form>

        </section>


        <!-- Items -->

        <h2 class="page-title">
            Available Found Items
        </h2>


        <div class="items-grid">

            <?php if (mysqli_num_rows($result) > 0): ?>

                <?php while ($item = mysqli_fetch_assoc($result)): ?>

                    <div class="item-card">

                        <div class="item-image">

                            <?php if (!empty($item['image'])): ?>

                                <img
                                    src="../<?= htmlspecialchars($item['image']) ?>"
                                    alt="<?= htmlspecialchars($item['item_name']) ?>"
                                >

                            <?php else: ?>

                                <div class="no-image">
                                    No Image
                                </div>

                            <?php endif; ?>

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

                            <p>
                                <strong>Color:</strong>
                                <?= htmlspecialchars($item['color']) ?>
                            </p>

                            <?php if (!empty($item['location'])): ?>

                                <p>
                                    <strong>Location:</strong>
                                    <?= htmlspecialchars($item['location']) ?>
                                </p>

                            <?php endif; ?>


                            <?php if (!empty($item['date_found'])): ?>

                                <p>
                                    <strong>Date Found:</strong>
                                    <?= htmlspecialchars($item['date_found']) ?>
                                </p>

                            <?php endif; ?>


                            <a
                                href="item-details.php?id=<?= $item['id'] ?>"
                                class="btn btn-primary"
                            >
                                View Details
                            </a>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="no-items">

                    <h3>
                        No found items available
                    </h3>

                    <p>
                        Try a different search or category.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </main>

</div>

</body>

</html>

<?php

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>