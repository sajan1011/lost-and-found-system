<?php

require "../includes/session-check.php";
require "../includes/db.php";

$user_id = $_SESSION['user_id'];

// Check whether item ID is provided
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: my-reports.php");
    exit();
}

$item_id = (int) $_GET['id'];

// Fetch the selected report belonging to the logged-in student
$sql = "SELECT * FROM items WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($result);

// Check whether the report exists
if (!$item) {
    $_SESSION['error'] = "Report not found.";
    header("Location: my-reports.php");
    exit();
}

?>