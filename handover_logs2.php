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

// Create ShiftLog table if it does not exist
$shiftLogCreationQuery = "CREATE TABLE IF NOT EXISTS ShiftLog (
    ShiftID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    SupervisorID INT NOT NULL,
    ShiftType ENUM('Morning', 'Afternoon', 'Evening', 'Night') NOT NULL,
    HazardReport TEXT,
    CoalExtract INT,
    OpEff DECIMAL(5,2),
    EquipUpTime DECIMAL(10,2),
    -- EquipStatus ENUM('Operable', 'Non operable', 'Dangerous') NOT NULL,
    PendingTasks TEXT
)";

if ($conn->query($shiftLogCreationQuery) !== TRUE) {
    echo "Error creating ShiftLog table: " . $conn->error;
}

// Create EquipmentHours table if it does not exist
$equipmentHoursCreationQuery = "CREATE TABLE IF NOT EXISTS EquipmentHours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipment_name VARCHAR(255) NOT NULL,
    total_hours INT NOT NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'Operational'
)";

if ($conn->query($equipmentHoursCreationQuery) !== TRUE) {
    echo "Error creating EquipmentHours table: " . $conn->error;
}

// Prepare and bind ShiftLog insert statement
$stmt = $conn->prepare("INSERT INTO ShiftLog (Date,SupervisorID, ShiftType, CoalExtract, OpEff, EquipUpTime, PendingTasks) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisddds", $date, $supervisorID, $shiftType, $coalextract, $opEff, $equipUpTime,$pendingTasks);

// Get data from POST request
$date = $_POST['shiftdate'];
$supervisorID=$_POST['supervisorId'];
$shiftType = $_POST['shiftType'];
$coalextract = $_POST['coalextract'];
$opEff = $_POST['OpEff'];
$equipUpTime = $_POST['EquipUptime'];
// $equipStatus = $_POST['equipmentStatus']; // This should be a dropdown in the HTML
$pendingTasks = $_POST['pendingTasks'];

// Handle hazard report
if (!empty($_POST['hazards'])) {
    $selectedHazards = implode(', ', $_POST['hazards']);
} else {
    $selectedHazards = "None"; // Default value if no hazards were selected
}

// Insert data into ShiftLog table
if ($stmt->execute()) {
    // Prepare to handle EquipmentHours
    $machines = isset($_POST['machines']) ? $_POST['machines'] : [];
    $overworked = isset($_POST['overworked']) ? $_POST['overworked'] : [];

    foreach ($machines as $machine) {
        $status = in_array($machine, $overworked) ? 'Overworked' : 'Operational';

        // Check if the machine already exists in the table
        $sql = "SELECT * FROM EquipmentHours WHERE equipment_name = ?";
        $stmt_check = $conn->prepare($sql);
        $stmt_check->bind_param("s", $machine);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            // Update the existing record
            $sql = "UPDATE EquipmentHours SET total_hours = total_hours + ?, status = ? WHERE equipment_name = ?";
        } else {
            // Insert a new record
            $sql = "INSERT INTO EquipmentHours (equipment_name, total_hours, status) VALUES (?, ?, ?)";
        }

        $stmt_update = $conn->prepare($sql);
        $stmt_update->bind_param("iis", $equipUpTime, $status, $machine);
        $stmt_update->execute();

        $stmt_check->close();
        $stmt_update->close();
    }

    // Redirect after successful data insertion
    header("Location: report_generate.php");
    exit();
} else {
    echo "Error inserting into ShiftLog table: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
<?php
require_once('path/to/tcpdf/tcpdf.php'); // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new PDF document
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Set PDF metadata
    $pdf->SetCreator('Your Company');
    $pdf->SetTitle('Shift Handover Report');
    $pdf->SetHeaderData('', 0, 'Shift Handover Report', 'Generated PDF');

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Collect form data
    $shiftDate = $_POST['shiftdate'];
    $shiftType = $_POST['shiftType'];
    $supervisorId = $_POST['supervisorId'];
    $hazards = isset($_POST['hazards']) ? implode(', ', $_POST['hazards']) : 'None';
    $otherHazard = $_POST['otherHazard'];
    $coalExtract = $_POST['coalextract'];
    $equipUptime = $_POST['EquipUptime'];
    $opEff = $_POST['OpEff'];
    $pendingTasks = $_POST['pendingTasks'];

    // Add form data to PDF
    $html = '
    <h1>Shift Handover Report</h1>
    <p><strong>Date:</strong> ' . htmlspecialchars($shiftDate) . '</p>
    <p><strong>Shift Type:</strong> ' . htmlspecialchars($shiftType) . '</p>
    <p><strong>Supervisor ID:</strong> ' . htmlspecialchars($supervisorId) . '</p>
    <p><strong>Hazards Reported:</strong> ' . htmlspecialchars($hazards) . ' ' . htmlspecialchars($otherHazard) . '</p>
    <p><strong>Amount of Coal Extracted:</strong> ' . htmlspecialchars($coalExtract) . ' tons</p>
    <p><strong>Equipment Up Time:</strong> ' . htmlspecialchars($equipUptime) . ' hours</p>
    <p><strong>Operational Efficiency:</strong> ' . htmlspecialchars($opEff) . '</p>
    <p><strong>Pending Tasks:</strong> ' . nl2br(htmlspecialchars($pendingTasks)) . '</p>';

    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('shift_handover_report.pdf', 'D'); // 'D' for download
} else {
    echo 'Invalid request method.';
}
?>
