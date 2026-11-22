<?php

require "../includes/session-check.php";
require "../includes/db.php";

$user_id = $_SESSION['user_id'];

// Check whether the form was submitted
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: my-reports.php");
    exit();
}

// Get form data
$item_id = (int) ($_POST['id'] ?? 0);
$item_name = trim($_POST['item_name'] ?? '');
$type = trim($_POST['type'] ?? '');
$category = trim($_POST['category'] ?? '');
$location = trim($_POST['location'] ?? '');
$date_reported = trim($_POST['date_reported'] ?? '');
$description = trim($_POST['description'] ?? '');

// Check whether the item belongs to the logged-in student
$sql = "SELECT * FROM items WHERE id = ? AND user_id = ?";

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

// Validate form data
if (
    $item_name == '' ||
    !in_array($type, ['lost', 'found'], true) ||
    $category == '' ||
    $location == '' ||
    $date_reported == '' ||
    $description == ''
) {
    $_SESSION['error'] = "Please fill in all required fields.";
    header("Location: edit-item.php?id=" . $item_id);
    exit();
}

// Keep the existing image unless a new one is uploaded
$image_path = $item['image'];

if (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {

    if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
        $_SESSION['error'] = "Image upload failed.";
        header("Location: edit-item.php?id=" . $item_id);
        exit();
    }

    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        $_SESSION['error'] = "Image size must be less than 5MB.";
        header("Location: edit-item.php?id=" . $item_id);
        exit();
    }

    $image_info = getimagesize($_FILES['image']['tmp_name']);

    if ($image_info === false) {
        $_SESSION['error'] = "Please upload a valid image.";
        header("Location: edit-item.php?id=" . $item_id);
        exit();
    }

    $allowed_types = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    $mime_type = $image_info['mime'];

    if (!isset($allowed_types[$mime_type])) {
        $_SESSION['error'] = "Only JPG, PNG and WEBP images are allowed.";
        header("Location: edit-item.php?id=" . $item_id);
        exit();
    }

    $upload_dir = "../uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $new_image_name = uniqid("item_", true) . "." . $allowed_types[$mime_type];

    $new_image_path = $upload_dir . $new_image_name;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $new_image_path)) {
        $_SESSION['error'] = "Unable to save the uploaded image.";
        header("Location: edit-item.php?id=" . $item_id);
        exit();
    }

    $image_path = "uploads/" . $new_image_name;
}

// Update report in database
$sql = "
    UPDATE items
    SET
        item_name = ?,
        type = ?,
        category = ?,
        location = ?,
        date_reported = ?,
        description = ?,
        image = ?
    WHERE id = ? AND user_id = ?
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param( $stmt, "sssssssii", $item_name, $type, $category,
    $location,$date_reported,$description,$image_path,$item_id,$user_id);

if (mysqli_stmt_execute($stmt)) {

    // Delete the old image after successful update
    if (
        !empty($_FILES['image']['name']) &&
        !empty($item['image']) &&
        file_exists("../" . $item['image'])
    ) {
        unlink("../" . $item['image']);
    }

    $_SESSION['success'] = "Report updated successfully!";
    header("Location: my-reports.php");
    exit();

} else {

    $_SESSION['error'] = "Unable to update report.";
    header("Location: edit-item.php?id=" . $item_id);
    exit();
}

?>