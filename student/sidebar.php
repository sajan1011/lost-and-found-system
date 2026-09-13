<aside class="sidebar">
    <a href="dashboard.php" class="brand">
        KBC Lost & Found
        <span>Student Panel</span>
    </a>
    <nav>
        <a href="dashboard.php" class="<?= $current_page == 'dashboard' ? 'active' : '' ?>">
            Dashboard
        </a>
        <a href="report-item.php" class="<?= $current_page == 'report' ? 'active' : '' ?>">
            Report Item
        </a>
        <a href="browse-items.php" class="<?= $current_page == 'browse' ? 'active' : '' ?>">
            Browse Items
        </a>
        <a href="my-reports.php" class="<?= $current_page == 'reports' ? 'active' : '' ?>">
            My Reports
        </a>
        <a href="my-claims.php" class="<?= $current_page == 'claims' ? 'active' : '' ?>">
            My Claims
        </a>
    </nav>
    <a href="../logout.php" class="logout-btn">Logout</a>

</aside>