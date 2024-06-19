<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, #35C2C1 50%, #E6F7F7 50%);
        }
        .container {
            width: 100%;
            max-width: 400px;
            text-align: center;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .otp-input {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .otp-input input {
            width: 50px;
            text-align: center;
            margin: 0 5px;
            padding: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .otp-input input:focus {
            border-color: #35C2C1;
            box-shadow: 0 0 5px rgba(53, 194, 193, 0.5);
            outline: none;
        }
        button {
            background-color: rgb(0, 0, 0);
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%; /* Full width */
        }
        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <p>Please enter the OTP sent to your mobile number or email address.</p>
        <form action="verify_otp_process.php" method="POST">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
            <div class="otp-input">
                <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" required>
            </div>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>
</html>
