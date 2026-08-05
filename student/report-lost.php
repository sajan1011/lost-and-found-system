<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Report Lost Item - Lost & Found System</title>

    <link rel="stylesheet" href="../assets/css/report-lost.css">
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">🔍</div>
            <div>
                <div class="brand-name">LFSC</div>
                <div class="brand-sub">Bernhardt College</div>
            </div>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">S</div>
            <div>
                <div class="user-name">Sajan Shrestha</div>
                <div class="user-roll">Roll: 46102193</div>
            </div>
        </div>

        <div class="nav-section-label">Main Menu</div>
        <ul class="nav-list">
            <li><a class="nav-link active" href="dashboard.php">
                    <span class="nav-icon">🏠</span> Dashboard
                </a></li>
            <li><a class="nav-link" href="browse-found.php">
                    <span class="nav-icon">🔎</span> Browse Found Items
                </a></li>
            <li><a class="nav-link" href="report-lost.php">
                    <span class="nav-icon">📋</span> Report Lost Item
                </a></li>
            <li><a class="nav-link" href="#">
                    <span class="nav-icon">📦</span> Report Found Item
                </a></li>
        </ul>

        <div class="nav-section-label">My Activity</div>
        <ul class="nav-list">
            <li><a class="nav-link" href="#">
                    <span class="nav-icon">📁</span> My Reports
                </a></li>
            <li><a class="nav-link" href="#">
                    <span class="nav-icon">🏷️</span> My Claims
                    <span class="nav-badge">2</span>
                </a></li>
            <li><a class="nav-link" href="#">
                    <span class="nav-icon">🔔</span> Notifications
                    <span class="nav-badge">3</span>
                </a></li>
            <li><a class="nav-link" href="#">
                    <span class="nav-icon">👤</span> My Profile
                </a></li>
        </ul>

        <div class="sidebar-footer">
            <div class="logout-btn">
                <span>🚪</span> Logout
            </div>
        </div>
    </aside>


    <!-- Main Content -->
    <main class="main-content">

        <div class="page-header">
            <h1>Report Lost Item</h1>
            <p>Provide details about the item you lost.</p>
        </div>


        <!-- Form Card -->
        <div class="form-card">

            <form>

                <div class="form-group">
                    <label for="item-name">Item Name</label>
                    <input type="text" id="item-name" name="item_name" placeholder="e.g. Black Wallet">
                </div>


                <div class="form-row">

                    <div class="form-group">
                        <label for="category">Category</label>

                        <select id="category" name="category">
                            <option value="">Select Category</option>
                            <option value="electronics">Electronics</option>
                            <option value="documents">Documents</option>
                            <option value="wallet">Wallet</option>
                            <option value="books">Books</option>
                            <option value="keys">Keys</option>
                            <option value="other">Other</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="color">Color</label>

                        <input type="text" id="color" name="color" placeholder="e.g. Black">
                    </div>

                </div>


                <div class="form-group">
                    <label for="date-lost">Date Lost</label>

                    <input type="date" id="date-lost" name="date_lost">
                </div>


                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea id="description" name="description" rows="5"
                        placeholder="Describe the item and where you think you lost it..."></textarea>
                </div>


                <div class="form-actions">
                    <a href="dashboard.php" class="cancel-btn">Cancel</a>

                    <button type="submit" class="submit-btn">
                        Submit Lost Report
                    </button>
                </div>

            </form>

        </div>

    </main>

</body>

</html>