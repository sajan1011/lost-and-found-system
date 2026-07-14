<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Lost and Found System | Register</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>

    <div class="register-container">
        <div class="register-box">
            <h2>Lost &amp; Found System For College</h2>
            <p class="subtitle">Create a Student Account</p>
            <form action="auth/register-handle.php" method="POST">
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter Full Name" required>
                </div>

                <div class="input-group">
                    <label>College Email</label>
                    <input type="email" name="email" placeholder="example@kbc.edu.np" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <button type="submit">
                    Register
                </button>

            </form>

            <p class="login-link">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </div>

    </div>

</body>

</html>