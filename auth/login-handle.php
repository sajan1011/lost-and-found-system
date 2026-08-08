<?php


session_start();
require "../includes/db.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../login.php");
    exit();
}
//Get form data and clean it 
$email = trim($_POST['email']);
$password = trim($_POST['password']);

//Find the user in the database by email
$query = "SELECT id, full_name, email, password, role FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

//Check if user exists
if (mysqli_num_rows($result) === 0) {
    $_SESSION['error'] = "No account found with that email.";
    header("Location: ../login.php");
    exit();
}


$user = mysqli_fetch_assoc($result);

//Check if the password is correct
if (!password_verify($password, $user['password'])) {
    $_SESSION['error'] = "Incorrect password. Please try again.";
    header("Location: ../login.php");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);


$_SESSION['user_id'] = $user['id'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role'];


if ($user['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
} else {
    header("Location: ../student/dashboard.php");
}
exit();
?>