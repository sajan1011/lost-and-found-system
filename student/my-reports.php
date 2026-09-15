<?php
$current_page = "reports";
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
                <p>
                    Manage the lost and found items you have reported.
                </p>
            </div>

            <a href="report-item.php" class="report-new-btn">
                + Report Item
            </a>

        </div>


        <!-- Summary Cards -->

        <div class="report-summary">

            <div class="report-stat">
                <div class="stat-icon lost-icon">
                    L
                </div>

                <div>
                    <h3>2</h3>
                    <p>Lost Reports</p>
                </div>
            </div>


            <div class="report-stat">
                <div class="stat-icon found-icon">
                    F
                </div>

                <div>
                    <h3>3</h3>
                    <p>Found Reports</p>
                </div>
            </div>


            <div class="report-stat">
                <div class="stat-icon active-icon">
                    ✓
                </div>

                <div>
                    <h3>4</h3>
                    <p>Active Reports</p>
                </div>
            </div>

        </div>


        <!-- Search / Filter -->

        <div class="reports-tools">

            <div class="report-search">

                <span>⌕</span>

                <input
                    type="text"
                    placeholder="Search your reports..."
                >

            </div>


            <select>
                <option>All Reports</option>
                <option>Lost Items</option>
                <option>Found Items</option>
            </select>


            <select>
                <option>All Status</option>
                <option>Active</option>
                <option>Claimed</option>
                <option>Closed</option>
            </select>

        </div>


        <!-- Reports -->

        <div class="reports-section-header">

            <div>
                <h2>Your Reports</h2>
                <span>5 reports found</span>
            </div>

        </div>


        <div class="reports-list">


            <!-- Report 1 -->

            <div class="report-card">

                <div class="report-image">
                    <div class="placeholder-image">
                        🎒
                    </div>
                </div>


                <div class="report-info">

                    <div class="report-title-row">

                        <div>
                            <span class="report-type lost">
                                LOST
                            </span>

                            <h3>Black College Bag</h3>
                        </div>

                        <span class="status active-status">
                            Active
                        </span>

                    </div>


                    <div class="report-details">

                        <span>
                            📁 Bag
                        </span>

                        <span>
                            📍 Library
                        </span>

                        <span>
                            📅 Sep 10, 2026
                        </span>

                    </div>


                    <p class="report-description">
                        Black backpack containing books and personal
                        belongings.
                    </p>


                    <div class="report-actions">

                        <a href="#" class="view-btn">
                            View Details
                        </a>

                        <a href="#" class="edit-btn">
                            Edit
                        </a>

                        <button class="delete-btn">
                            Delete
                        </button>

                    </div>

                </div>

            </div>


            <!-- Report 2 -->

            <div class="report-card">

                <div class="report-image">
                    <div class="placeholder-image">
                        🧮
                    </div>
                </div>


                <div class="report-info">

                    <div class="report-title-row">

                        <div>
                            <span class="report-type found">
                                FOUND
                            </span>

                            <h3>Scientific Calculator</h3>
                        </div>

                        <span class="status active-status">
                            Active
                        </span>

                    </div>


                    <div class="report-details">

                        <span>
                            📁 Other
                        </span>

                        <span>
                            📍 Block A
                        </span>

                        <span>
                            📅 Sep 8, 2026
                        </span>

                    </div>


                    <p class="report-description">
                        Scientific calculator found near the classroom.
                    </p>


                    <div class="report-actions">

                        <a href="#" class="view-btn">
                            View Details
                        </a>

                        <a href="#" class="edit-btn">
                            Edit
                        </a>

                        <button class="delete-btn">
                            Delete
                        </button>

                    </div>

                </div>

            </div>


            <!-- Report 3 -->

            <div class="report-card">

                <div class="report-image">
                    <div class="placeholder-image">
                        🪪
                    </div>
                </div>


                <div class="report-info">

                    <div class="report-title-row">

                        <div>
                            <span class="report-type lost">
                                LOST
                            </span>

                            <h3>Student ID Card</h3>
                        </div>

                        <span class="status closed-status">
                            Closed
                        </span>

                    </div>


                    <div class="report-details">

                        <span>
                            📁 ID Card
                        </span>

                        <span>
                            📍 Cafeteria
                        </span>

                        <span>
                            📅 Aug 28, 2026
                        </span>

                    </div>


                    <p class="report-description">
                        College identification card with student details.
                    </p>


                    <div class="report-actions">

                        <a href="#" class="view-btn">
                            View Details
                        </a>

                    </div>

                </div>

            </div>


        </div>

    </main>

</div>

</body>
</html>