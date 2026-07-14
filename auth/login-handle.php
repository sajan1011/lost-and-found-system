<?php
session_start();
require_once '../includes/db-conn.php';
// 1. query
// 2. prepare query
// 3. bind parameters
// 4. execute
// 5. get result
// 6. fetch assoc

//my sqli procedural approach


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if email exists
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == "admin") {
                header("Location: ../admin/dashboard.php");
                exit();

            } else {
                header("Location: ../student/dashboard.php");
                exit();
            }
        } else {
            echo "Incorrect Password.";
        }
    } else {
        echo "Email not found.";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>