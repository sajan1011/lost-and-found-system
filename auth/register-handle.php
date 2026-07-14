<?php

require "../includes/db-conn.php";

$full_name = trim($_POST['full_name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

// Check password match
if ($password != $confirm_password) {
    die("Passwords do not match.");
}

// Allow only college email
if (!str_ends_with($email, "@kbc.edu.np")) {
    die("Please use your college email.");
}

// Check existing email
$query = "SELECT id FROM users WHERE email=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    die("Email already exists.");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users(full_name,email,password,role)
VALUES(?,?,?,'student')";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $hashed_password);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../login.php");
    exit();

} else {
    echo "Registration Failed.";
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>