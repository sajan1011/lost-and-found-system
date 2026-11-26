
<?php

require "../includes/session-check.php";
require "../includes/db.php";

$user_id = $_SESSION['user_id'];

// Check item ID
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: dashboard.php");
    exit();
}

$item_id = (int) $_GET['id'];

// Fetch found item
$sql = "SELECT * FROM items
        WHERE id = ? AND type = 'found'
        AND status = 'active' AND user_id != ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($result);

// Check whether item exists
if (!$item) {
    $_SESSION['error'] = "This item is not available for claiming.";
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Item | KBC Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include "sidebar.php"; ?>
    <div class="main-content">
        <h2>Claim Found Item</h2>
        <div class="claim-item-container">
            <h3><?= htmlspecialchars($item['item_name']) ?></h3>
            <p>
                <strong>Category:</strong>
                <?= htmlspecialchars($item['category']) ?>
            </p>

            <p>
                <strong>Location:</strong>
                <?= htmlspecialchars($item['location']) ?>
            </p>

            <p>
                <strong>Description:</strong>
                <?= htmlspecialchars($item['description']) ?>
            </p>

            <form action="claim-handle.php" method="POST">
                <input type="hidden" name="item_id"
                    value="<?= htmlspecialchars($item['id']) ?>">
                <label>Explain why this item belongs to you</label>
                <textarea name="message"
                    placeholder="Describe unique features or details that can prove ownership..."
                    required></textarea>
                <button type="submit" name="submit_claim">
                    Submit Claim
                </button>
                <a href="dashboard.php">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
