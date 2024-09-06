<?php
// login.php

// Simulate user credentials for demo (replace with real authentication logic)
$valid_username = "user";
$valid_password = "password";

// Retrieve form data
$username = $_POST['name1'];
$password = $_POST['password'];

// Validate the user
if ($username === $valid_username && $password === $valid_password) {
    // Start a session (if needed)
    session_start();
    $_SESSION['username'] = $username;
    
    // Redirect to dashboard
    header("Location: dashboard.php");
    exit(); // Ensure no further code is executed after the redirect
} else {
    // Redirect to login with error message
    header("Location: login.html?error=invalid_credentials");
    exit();
}
?>
