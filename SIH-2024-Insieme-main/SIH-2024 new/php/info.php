<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: Login.html');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save user info in session
    $_SESSION['user_info'] = [
        'name' => $_POST['name'],
        'education' => $_POST['education'],
        'profession' => $_POST['profession']
    ];

    // Redirect to verify.php
    header('Location: verify.php');
    exit();
}

// Retrieve data from query parameters if available
$name = isset($_GET['name']) ? urldecode($_GET['name']) : '';
$education = isset($_GET['education']) ? urldecode($_GET['education']) : '';
$profession = isset($_GET['profession']) ? urldecode($_GET['profession']) : '';

// Optionally clear the query parameters after pre-filling
if (!empty($name) || !empty($education) || !empty($profession)) {
    // The following line is optional: it ensures the data does not persist after a refresh
    $_GET = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Form</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <form action="info.php" method="POST" class="register">
        <h1>Information Form</h1>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        
        <label for="education">Education:</label>
        <select id="education" name="education" required>
            <option value="" disabled <?php echo empty($education) ? 'selected' : ''; ?>>Select Education</option>
            <option value="Higher Education" <?php echo $education === 'Higher Education' ? 'selected' : ''; ?>>Higher Education</option>
            <option value="University" <?php echo $education === 'University' ? 'selected' : ''; ?>>University</option>
            <option value="Others" <?php echo $education === 'Others' ? 'selected' : ''; ?>>Others</option>
        </select>
        
        <label for="profession">Profession:</label>
        <select id="profession" name="profession" required>
            <option value="" disabled <?php echo empty($profession) ? 'selected' : ''; ?>>Select Profession</option>
            <option value="Teacher" <?php echo $profession === 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
            <option value="Student" <?php echo $profession === 'Student' ? 'selected' : ''; ?>>Student</option>
            <option value="Freelancer" <?php echo $profession === 'Freelancer' ? 'selected' : ''; ?>>Freelancer</option>
            <option value="Businessman" <?php echo $profession === 'Businessman' ? 'selected' : ''; ?>>Businessman</option>
            <option value="Others" <?php echo $profession === 'Others' ? 'selected' : ''; ?>>Others</option>
        </select>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
