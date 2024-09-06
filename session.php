<?php
session_start();

// Get POST data
$username = $_POST['name1'];
$password = $_POST['password'];
$remember_me = isset($_POST['remember_me']); // Check if "Remember me" is checked

// Basic validation (replace with real validation logic)
if (!empty($username) && !empty($password)) {
    // Set session variables
    $_SESSION['username'] = $username;

    // Set cookies if "Remember me" is checked
    if ($remember_me) {
        setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
    }

    // Redirect to info.php
    header('Location: info.php');
    exit();
} else {
    echo 'Invalid login';
}
?>
