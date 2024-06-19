<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Sign Up Page</title>
</head>
<body>
    <div class="container-fluid">
        <div class="form-container">
            <div class="form-content">
                <h2>Hello! Register for an account</h2>
                <form id="signupForm" action="signup_process.php" method="post">
                    <input type="text" placeholder="Enter Your User Name" name="username" required>
                    <input type="email" placeholder="Enter Your Email" name="email" required>
                    <div class="password-container">
                        <input type="password" id="password" placeholder="Create a Password" name="password" required>
                    </div>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" required>
                    <button type="submit">Sign Up</button>
                </form>
                    <div class="login">
                        Already have an account? <a href="./login.php">Log In</a>
                    </div>
                
            </div>
        </div>
    </div>
    <!-- <script src="./signup.js"></script> -->
</body>
</html>
