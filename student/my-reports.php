<?php

require "../includes/session-check.php";
require "../includes/db.php";

$current_page = "reports";

$user_id = $_SESSION['user_id'];

// Summary counts
$count_sql = "
    SELECT
        COUNT(*) AS total,
        SUM(type = 'lost') AS lost,
        SUM(type = 'found') AS found
    FROM items
    WHERE user_id = ?
";

$count_stmt = mysqli_prepare($conn, $count_sql);

mysqli_stmt_bind_param(
    $count_stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($count_stmt);

$count_result = mysqli_stmt_get_result($count_stmt);

$counts = mysqli_fetch_assoc($count_result);

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

            <div class="reports-header">
                <div>
                    <h1>My Reports</h1>
                    <p>
                        Manage the items you have reported.
                    </p>
                </div>
                <a href="report-item.php" class="report-new-btn">+ Report Item
                </a>

            </div>

            <!-- Summary -->

            <div class="report-summary">
                <div class="report-stat">
                    <div class="stat-icon lost-icon"> L
                    </div>
                    <div>
                        <h3>
                            <?= $counts['lost'] ?? 0 ?>
                        </h3>
                        <p>Lost Reports</p>
                    </div>
                </div>
                <div class="report-stat">
                    <div class="stat-icon found-icon"> F
                    </div>
                    <div>
                        <h3>
                            <?= $counts['found'] ?? 0 ?>
                        </h3>

                        <p>Found Reports</p>

                    </div>
                </div>

                <div class="report-stat">
                    <div class="stat-icon active-icon">
                        ✓
                    </div>
                    <div>
                        <h3>
                            <?= $counts['active'] ?? 0 ?>
                        </h3>
                        <p>Active Reports</p>
                    </div>
                </div>
            </div>

            <!-- Reports heading -->

            <div class="reports-section-header">
                <div>
                    <h2>Your Reports</h2>
                    <span>
                        <?= $counts['total'] ?? 0 ?> reports found
                    </span>
                </div>
            </div>

            <!-- Reports -->

            <div class="reports-list">

                <?php
                if ($counts['total'] > 0):

                    while ($item = mysqli_fetch_assoc($result)):

                        ?>
                        <div class="report-card">


                            <!-- Image -->

                            <div class="report-image">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="../<?= htmlspecialchars($item['image']) ?>"
                                        alt="<?= htmlspecialchars($item['item_name']) ?>">

                                <?php else: ?>
                                    <div class="placeholder-image"> 📦
                                    </div>
                                <?php endif; ?>
                            </div>


                            <!-- Information -->

                            <div class="report-info">
                                <div class="report-title-row">
                                    <div>
                                        <span class="report-type
                                        <?= $item['type'] == 'lost' ? 'lost' : 'found' ?>">
                                            <?= strtoupper(
                                                htmlspecialchars($item['type'])
                                            ) ?>

                                        </span>
                                        <h3>
                                            <?= htmlspecialchars(
                                                $item['item_name']
                                            ) ?>
                                        </h3>

                                    </div>
                                    <span class="status
                                    <?=
                                        $item['status'] == 'active'
                                        ? 'active-status'
                                        : 'closed-status'
                                        ?>">

                                        <?= htmlspecialchars(
                                            ucfirst($item['status'])
                                        ) ?>

                                    </span>


                                </div>

                                <!-- Details -->

                                <div class="report-details">

                                    <span>
                                        📁
                                        <?= htmlspecialchars(
                                            $item['category']
                                        ) ?>
                                    </span>


                                    <?php if (!empty($item['location'])): ?>

                                        <span>
                                            📍
                                            <?= htmlspecialchars(
                                                $item['location']
                                            ) ?>
                                        </span>

                                    <?php endif; ?>


                                    <span>

                                        📅

                                        <?php

                                        if (
                                            $item['type'] == 'lost'
                                            && !empty($item['date_lost'])
                                        ) {

                                            echo htmlspecialchars(
                                                $item['date_lost']
                                            );

                                        } elseif (
                                            $item['type'] == 'found'
                                            && !empty($item['date_found'])
                                        ) {

                                            echo htmlspecialchars(
                                                $item['date_found']
                                            );

                                        }

                                        ?>

                                    </span>

                                </div>



                                <!-- Description -->

                                <p class="report-description">

                                    <?= htmlspecialchars(
                                        $item['description']
                                    ) ?>

                                </p>



                                <!-- Actions -->

                                <div class="report-actions">


                                    <a href="item-details.php?id=<?= $item['id'] ?>" class="view-btn">
                                        View Details
                                    </a>


                                    <a href="edit-item.php?id=<?= $item['id'] ?>" class="edit-btn">
                                        Edit
                                    </a>


                                    <a href="delete-item.php?id=<?= $item['id'] ?>" class="delete-btn" onclick="return confirm(
                                        'Are you sure you want to delete this report?'
                                    );">
                                        Delete
                                    </a>


                                </div>


                            </div>


                        </div>


                    <?php endwhile; ?>


                <?php else: ?>


                    <div class="no-items">

                        <h3>No reports found</h3>

                        <p>
                            You have not reported any items matching your search.
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
mysqli_stmt_close($count_stmt);

mysqli_close($conn);

?>