<?php


session_start();
require "../includes/db.php"; 

//Only run if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../register.php");
    exit();
}

//Get the form data and clean it
$full_name = trim($_POST['full_name']);       
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);


if ($password !== $confirm_password) {
    $_SESSION['error'] = "Passwords do not match.";
    header("Location: ../register.php");
    exit();
}

//Only allow college email addresses
if (!str_ends_with($email, "@kbc.edu.np")) {
    $_SESSION['error'] = "Only KBC College email (@kbc.edu.np) is allowed.";
    header("Location: ../register.php");
    exit();
}

//Check if phone is exactly 10 digits
if (!preg_match('/^[0-9]{10}$/', $phone)) {
    $_SESSION['error'] = "Phone number must be exactly 10 digits.";
    header("Location: ../register.php");
    exit();
}


$query = "SELECT id FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email); 
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "This email is already registered. Please login.";
    header("Location: ../register.php");
    exit();
}
mysqli_stmt_close($stmt);


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//Insert the new user into the database
$query = "INSERT INTO users (full_name, email, phone, password, role)
          VALUES (?, ?, ?, ?, 'student')";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $phone, $hashed_password);

if (mysqli_stmt_execute($stmt)) {
    
    $_SESSION['success'] = "Account created successfully! Please login.";
    header("Location: ../login.php");
    exit();
} else {
   
    $_SESSION['error'] = "Registration failed. Please try again.";
    header("Location: ../register.php");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>