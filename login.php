<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found System | Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

    <div class="login-container">

        <div class="login-box">
            <h2>Lost & Found System For College</h2>
            <p class="subtitle">Login to Continue</p>

            <form action="auth/login-handle.php" method="POST">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="example@kbc.edu.np" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>

                <button type="submit">
                    Login
                </button>
            </form>
            <p class="register-link">
                Don't have an account?
                <a href="register.php">Register</a>
            </p>
        </div>
    </div>
</body>

</html>