<?php


session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBC College | Lost and Found - Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head> 

<body>

    <div class="login-container">
        <div class="login-box">

            <h2>KBC College</h2>
            <h3>Lost &amp; Found System</h3>
            <p class="subtitle">Login to Continue</p>

            <?php if (isset($_SESSION['error'])): ?>
                <p class="msg error">
                    <?= $_SESSION['error']; ?>
                </p>
                <?php unset($_SESSION['error']);  ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <p class="msg success">
                    <?= $_SESSION['success']; ?>
                </p>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            
            <form action="auth/login-handle.php" method="POST">

                <div class="input-group">
                    <label>College Email</label>
                    <input type="email" name="email" placeholder="example@kbc.edu.np" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>

                <button type="submit">Login</button>

            </form>

            <p class="register-link">
                Don't have an account?
                <a href="register.php">Register</a>
            </p>

        </div>
    </div>

</body>

</html>