<?php
session_start();
require 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($email) || empty($password)) {
        echo "Email and Password are required.";
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password, is_verified FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($id, $hashed_password, $is_verified);
        $stmt->fetch();

        if ($is_verified == 0) {
            echo "Your account is not verified.";
            exit();
        }

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Start session and set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            // Redirect based on role
            if ($role == 'user') {
                header("Location: index.html");
            } elseif ($role == 'owner') {
                header("Location: owner_portal.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email and role.";
    }

    $stmt->close();
    $conn->close();
}
?>
