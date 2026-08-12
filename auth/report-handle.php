<?php
require "../includes/session-check.php";
require "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: report-item.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$type = $_POST['type'];
$title = trim($_POST['title']);
$category = $_POST['category'];
$location = $_POST['location'];
$date = $_POST['date_reported'];
$description = trim($_POST['description']);
$image = null;

if (!empty($_FILES['image']['name'])) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $filename = $_FILES['image']['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        $_SESSION['error'] = "Only JPG, JPEG, PNG, GIF images are allowed.";
        header("Location: report-item.php");
        exit();
    }

    $new_filename = time() . '_' . uniqid() . '.' . $ext;
    $upload_path = "../assets/uploads/" . $new_filename;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
        $_SESSION['error'] = "Image upload failed. Please try again.";
        header("Location: report-item.php");
        exit();
    }

    $image = $new_filename;
}

$query = "INSERT INTO items (user_id, type, title, category, location, date_reported, description, image)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "isssssss", $user_id, $type, $title, $category, $location, $date, $description, $image);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Item reported successfully!";
    header("Location: dashboard.php");
} else {
    $_SESSION['error'] = "Something went wrong. Please try again.";
    header("Location: report-item.php");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();
?>