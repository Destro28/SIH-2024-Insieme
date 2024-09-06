<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Set your password if needed
$dbname = "sih-1645";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if it does not exist
$tableCreationQuery = "CREATE TABLE IF NOT EXISTS ShiftLog (
    ShiftID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    ShiftType ENUM('Morning', 'Afternoon', 'Evening', 'Night') NOT NULL,
    HazardReport TEXT,
    CoalExtract INT,
    OpEff DECIMAL(5,2),
    EquipUpTime DECIMAL(10,2),
    EquipStatus ENUM('Operable', 'Non operable', 'Dangerous'),
    PendingTasks TEXT
)";

if ($conn->query($tableCreationQuery) === TRUE) {
    // Table created successfully or already exists
    header("Location: table_render.php");
} else {
    echo "Error creating table: " . $conn->error;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO ShiftLog (Date, ShiftType, HazardReport, CoalExtract, OpEff, EquipUpTime, EquipStatus, PendingTasks) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $date, $shiftType, $hazardReport, $coalextract, $opEff, $equipUpTime, $equipStatus, $pendingTasks);

// Get data from POST request
$date = $_POST['shiftdate'];
$shiftType = $_POST['shiftType'];
$hazardReport = $_POST['hazardReport'];
$coalExtract = $_POST['coalextract'];
$opEff = $_POST['OpEff'];
$equipUpTime = $_POST['EquipUptime'];
$equipStatus = $_POST['equipmentStatus'];
$pendingTasks = $_POST['pendingTasks'];

// Execute the statement
if ($stmt->execute()) {
    // echo "New record created successfully";

    
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();



?>
