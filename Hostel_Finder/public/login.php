<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container-fluid">
        <div class="form-container">
            <div class="form-content">
                <h2>Welcome back! Glad to see you, Again!</h2>
                <form id="loginForm" action="login_process.php" method="post">
                    <div class="radio-buttons" style="border: 1px solid black;">
                        <input type="radio" id="user" name="role" value="user" checked>
                        <label for="user">User</label>
                        <input type="radio" id="owner" name="role" value="owner">
                        <label for="owner">Owner</label>
                    </div>
                    <input type="email" name="email" placeholder="Enter Your Email" required>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </div>
                    <a href="./password_reset.html" style="margin: 10px 0;">Forgot Password?</a>
                    <button type="submit" style="padding: 15px; font-size: 18px;">Login</button>

                    <div class="register">
                        Don't have an account? <a href="./signup.php">Register Now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <script src="./login.js"></script> -->
</body>
</html>
