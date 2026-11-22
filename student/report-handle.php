<?php

require "../includes/session-check.php";
require "../includes/db.php";

$user_id = $_SESSION['user_id'];

// Get form data
$type = trim($_POST['type'] ?? '');
$title = trim($_POST['title'] ?? '');
$category = trim($_POST['category'] ?? '');
$location = trim($_POST['location'] ?? '');
$date_reported = trim($_POST['date_reported'] ?? '');
$description = trim($_POST['description'] ?? '');

// Validate required fields
if (
    !in_array($type, ['lost', 'found'], true) ||
    $title === '' ||
    $category === '' ||
    $location === '' ||
    $date_reported === '' ||
    $description === ''
) {
    $_SESSION['error'] = "Please fill in all required fields.";
    header("Location: report-item.php");
    exit();
}

// Validate date
$date = DateTime::createFromFormat('Y-m-d', $date_reported);

if (
    !$date ||
    $date->format('Y-m-d') !== $date_reported ||
    $date_reported > date('Y-m-d')
) {
    $_SESSION['error'] = "Please enter a valid date.";
    header("Location: report-item.php");
    exit();
}

// Image upload
$image_path = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "Image upload failed.";
        header("Location: report-item.php");
        exit();
    }

    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        $_SESSION['error'] = "Image must be smaller than 5 MB.";
        header("Location: report-item.php");
        exit();
    }

    $image_info = getimagesize($_FILES['image']['tmp_name']);

    $allowed_types = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    if (
        $image_info === false ||
        !isset($allowed_types[$image_info['mime']])
    ) {
        $_SESSION['error'] = "Only JPG, PNG and WEBP images are allowed.";
        header("Location: report-item.php");
        exit();
    }

    $upload_dir = "../uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_name = bin2hex(random_bytes(16)) . "." .
        $allowed_types[$image_info['mime']];

    if (
        !move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $upload_dir . $file_name
        )
    ) {
        $_SESSION['error'] = "Unable to upload image.";
        header("Location: report-item.php");
        exit();
    }

    $image_path = "uploads/" . $file_name;
}

// Insert report into database
$sql = "
    INSERT INTO items(user_id,type,item_name,description,category,location,date_reported,image)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    if ($image_path !== null) {
        unlink("../" . $image_path);
    }

    $_SESSION['error'] = "Unable to prepare report.";
    header("Location: report-item.php");
    exit();
}

mysqli_stmt_bind_param($stmt,"isssssss",$user_id,$type,$title,$description,$category,$location,
    $date_reported, $image_path);

if (mysqli_stmt_execute($stmt)) {

    $_SESSION['success'] = "Report submitted successfully.";
    header("Location: my-reports.php");
    exit();

} else {

    if ($image_path !== null) {
        unlink("../" . $image_path);
    }

    $_SESSION['error'] = "Failed to submit report.";
    header("Location: report-item.php");
    exit();
}

?>