
<?php

require "../includes/session-check.php";
require "../includes/db.php";

$user_id = $_SESSION['user_id'];

// Check item ID
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: my-reports.php");
    exit();
}

$item_id = (int) $_GET['id'];

// Fetch report belonging to the logged-in student
$sql = "SELECT image FROM items WHERE id = ? AND user_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($result);

if (!$item) {
    $_SESSION['error'] = "Report not found.";
    header("Location: my-reports.php");
    exit();
}

// Delete report
$sql = "DELETE FROM items WHERE id = ? AND user_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);

if (mysqli_stmt_execute($stmt)) {

    // Delete uploaded image
    if (!empty($item['image']) && strpos($item['image'], 'uploads/') === 0) {

        $image_path = "../" . $item['image'];

        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    $_SESSION['success'] = "Report deleted successfully!";

} else {

    $_SESSION['error'] = "Unable to delete report.";
}

header("Location: my-reports.php");
exit();

?>
