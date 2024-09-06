<?php
// Database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "sih-1645";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it does not exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS `sih-1645`";
if (!$conn->query($sql_create_db)) {
    die("Database creation failed: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create the table if it does not exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS `register` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fname` VARCHAR(50) NOT NULL,
    `lname` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `psswrd` VARCHAR(255) NOT NULL,
    `dob` DATE NOT NULL,
    `designation` ENUM('admin', 'super') NOT NULL,
    `area` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($sql_create_table)) {
    die("Table creation failed: " . $conn->error);
}

// Retrieve form data and validate
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$username = trim($_POST['username']);
$psswrd = $_POST['psswrd'];
$dob = $_POST['dob'];
$designation = $_POST['designation'];
$area = $_POST['area'];

// Form validation
if (empty($fname) || empty($lname) || empty($email) || empty($username) || empty($psswrd)) {
    die("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

if (strlen($psswrd) < 6) {
    die("Password must be at least 6 characters long.");
}

$birthDate = strtotime($dob);
if ($birthDate === false || $birthDate >= time()) {
    die("Please enter a valid date of birth.");
}

// Hash the password before storing
$hashed_password = password_hash($psswrd, PASSWORD_BCRYPT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO register (fname, lname, email, psswrd, dob, designation, area, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $fname, $lname, $email, $hashed_password, $dob, $designation, $area, $username);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully";
    header("Location: dashboard.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>\ssssssssssssssssssssssssssssssdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx