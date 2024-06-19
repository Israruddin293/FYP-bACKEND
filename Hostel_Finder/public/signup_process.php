<?php
session_start();
require 'config.php'; 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the default time zone to Pakistan
date_default_timezone_set('Asia/Karachi');

// signup_process.php

require 'Mail/phpmailer/class.phpmailer.php';
require 'Mail/phpmailer/class.smtp.php';



// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $confirm_password = $conn->real_escape_string($_POST["confirm_password"]);

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $otp_int = mt_rand(100000, 999999); // Generate random OTP
    $otp = (string)$otp_int;
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP expiry in 10 minutes
    $created_at = date('Y-m-d H:i:s'); // Current timestamp

    // Check if email already exists and its verification status
    $stmt = $conn->prepare("SELECT id, is_verified FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $is_verified);
        $stmt->fetch();
        
        if ($is_verified == 1) {
            echo "An account with this email already exists and is verified.";
        } else {
            // Email exists but is not verified, update existing user
            $update_stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, otp = ?, otp_expiry = ?, created_at = ? WHERE email = ?");
            $update_stmt->bind_param("ssssss", $username, $password_hashed, $otp, $otp_expiry, $created_at, $email);

            if ($update_stmt->execute()) {
                // Send OTP to user's email
                $to = $email;
                $subject = 'Account Verification OTP';
                $message = 'Your OTP for account verification is: ' . $otp;

                // Create PHPMailer instance
                $mail = new PHPMailer(true); 
                
                try {
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'uisrar293@gmail.com'; // Replace with your Gmail email address
                    $mail->Password = 'abzx nxip svsl fvuw'; // Replace with your Gmail password or app-specific password
                    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
                    $mail->Port = 587; // Port for TLS
                    
                    // Email content
                    $mail->setFrom('uisrar293@gmail.com', 'Hostel Finder'); // Replace with your name and email
                    $mail->addAddress($to);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                
                    // Send email
                    $mail->send();

                    // Redirect to OTP verification page
                    header("Location: otp_verification.php?email=" . urlencode($email));
                    exit();
                } catch (phpmailerException $e) { // Catch phpmailerException instead of Exception
                    echo "Failed to send OTP. Error: " . $mail->ErrorInfo;
                }
            } else {
                echo "Error: " . $conn->error;
            }

            $update_stmt->close();
        }
    } else {
        // Email does not exist, proceed with registration
        $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password, otp, otp_expiry, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("ssssss", $username, $email, $password_hashed, $otp, $otp_expiry, $created_at);

        if ($insert_stmt->execute()) {
            // Send OTP to user's email
            $to = $email;
            $subject = 'Account Verification OTP';
            $message = 'Your OTP for account verification is: ' . $otp;

            // Create PHPMailer instance
            $mail = new PHPMailer(true); // Passing true enables exceptions
            
            try {
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'uisrar293@gmail.com'; // Replace with your Gmail email address
                $mail->Password = 'abzx nxip svsl fvuw'; // Replace with your Gmail password or app-specific password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption
                $mail->Port = 587; // Port for TLS
                
                // Email content
                $mail->setFrom('uisrar293@gmail.com', 'Hostel Finder'); // Replace with your name and email
                $mail->addAddress($to);
                $mail->Subject = $subject;
                $mail->Body = $message;
            
                // Send email
                $mail->send();

                // Redirect to OTP verification page
                header("Location: otp_verification.php?email=" . urlencode($email));
                exit();
            } catch (phpmailerException $e) { // Catch phpmailerException instead of Exception
                echo "Failed to send OTP. Error: " . $mail->ErrorInfo;
            }
        } else {
            echo "Error: " . $conn->error;
        }

        $insert_stmt->close();
    }

    $stmt->close();
}

$conn->close();
?>
