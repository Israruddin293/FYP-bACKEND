<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'config.php';

// Process OTP verification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Combine OTP inputs into a single string
    $otp = implode("", $_POST['otp']);
    $email = $_POST['email']; // Get email from form input

    // Sanitize inputs
    $otp = trim($otp);
    $email = trim($email);

    // Debugging: Output sanitized inputs
    echo "Sanitized Entered OTP: '$otp'<br>";
    echo "Sanitized Email: '$email'<br>";

    // Prepare and execute the SELECT statement
    $stmt = $conn->prepare("SELECT otp, otp_expiry FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_otp = $row['otp'];
        $otp_expiry = $row['otp_expiry'];

        // Debugging: Output the fetched OTP and expiry time
        echo "Fetched Stored OTP: '$stored_otp'<br>";
        echo "Fetched OTP Expiry: '$otp_expiry'<br>";

        // Convert OTP expiry time to local time zone (Asia/Karachi)
        $otp_expiry_date = new DateTime($otp_expiry, new DateTimeZone('Asia/Karachi'));
        $otp_expiry_date->setTimezone(new DateTimeZone('Asia/Karachi'));

        // Get current time in local time zone (Asia/Karachi)
        $current_time = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        
        // Debugging: Output the current time and expiry time
        echo "Current Time: " . $current_time->format('Y-m-d H:i:s') . "<br>";
        echo "OTP Expiry Time: " . $otp_expiry_date->format('Y-m-d H:i:s') . "<br>";

        // Check if OTP matches and is not expired
        if ($otp === $stored_otp && $otp_expiry_date > $current_time) {
            echo "OTP verification successful.";
            
            // Update the database to set otp_verified or take appropriate action
            $update_stmt = $conn->prepare("UPDATE users SET is_verified = 1 WHERE email = ?");
            $update_stmt->bind_param("s", $email);
            
            if ($update_stmt->execute() === TRUE) {
                echo "Account verified successfully.";
                // Redirect to a success page or login page
                header("Location: login.php");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
            
            $update_stmt->close();
        } else {
            echo "Invalid or expired OTP.";
        }
    } else {
        echo "No user found with this email.";
    }

    $stmt->close();
}

$conn->close();
?>
