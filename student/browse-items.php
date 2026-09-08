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
            <a href="dashboard.php">Dashboard</a>
            <a href="report-item.php">Report Item</a>
            <a href="browse-items.php" class="active">Browse Items</a>
            <a href="my-reports.php">My Reports</a>
            <a href="my-claims.php">My Claims</a>
        </nav>

        <a href="../logout.php" class="logout-btn">Logout</a>

    </aside>


    <!-- Main Content -->
    <main class="main">

        <div class="topbar">
            <h1 class="page-title"
                style="border:none; margin:0; padding:0;">
                Browse Items
            </h1>

            <div class="welcome">
                Lost something? Find it here.
            </div>
        </div>


        <!-- Search and Filter -->
        <section class="browse-controls">

            <div class="search-box">
                <input
                    type="text"
                    placeholder="Search items..."
                >

                <button class="btn btn-primary">
                    Search
                </button>
            </div>

            <div class="filter-box">

                <select>
                    <option value="">All Categories</option>
                    <option>Electronics</option>
                    <option>Documents</option>
                    <option>Books</option>
                    <option>Accessories</option>
                    <option>Others</option>
                </select>

                <select>
                    <option value="">All Items</option>
                    <option>Lost Items</option>
                    <option>Found Items</option>
                </select>

            </div>

        </section>


        <!-- Items -->
        <h2 class="page-title">Available Items</h2>

        <div class="items-grid">

            <!-- Item 1 -->
            <div class="item-card">

                <div class="item-image">
                    <img src="../assets/images/sample-item.jpg"
                         alt="Black Wallet">
                </div>

                <div class="item-details">

                    <span class="item-status found">
                        Found
                    </span>

                    <h3>Black Wallet</h3>

                    <p>
                        <strong>Category:</strong>
                        Accessories
                    </p>

                    <p>
                        <strong>Color:</strong>
                        Black
                    </p>

                    <p>
                        <strong>Date:</strong>
                        2026-09-05
                    </p>

                    <a href="item-details.php"
                       class="btn btn-primary">
                        View Details
                    </a>

                </div>

            </div>


            <!-- Item 2 -->
            <div class="item-card">

                <div class="item-image">
                    <img src="../assets/images/sample-item.jpg"
                         alt="Calculator">
                </div>

                <div class="item-details">

                    <span class="item-status found">
                        Found
                    </span>

                    <h3>Scientific Calculator</h3>

                    <p>
                        <strong>Category:</strong>
                        Electronics
                    </p>

                    <p>
                        <strong>Color:</strong>
                        Black
                    </p>

                    <p>
                        <strong>Date:</strong>
                        2026-09-03
                    </p>

                    <a href="item-details.php"
                       class="btn btn-primary">
                        View Details
                    </a>

                </div>

            </div>


            <!-- Item 3 -->
            <div class="item-card">

                <div class="item-image">
                    <img src="../assets/images/sample-item.jpg"
                         alt="Student ID Card">
                </div>

                <div class="item-details">

                    <span class="item-status found">
                        Found
                    </span>

                    <h3>Student ID Card</h3>

                    <p>
                        <strong>Category:</strong>
                        Documents
                    </p>

                    <p>
                        <strong>Color:</strong>
                        White
                    </p>

                    <p>
                        <strong>Date:</strong>
                        2026-09-01
                    </p>

                    <a href="item-details.php"
                       class="btn btn-primary">
                        View Details
                    </a>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>