<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sih-1645";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get today's date
$currentDate = date('Y-m-d');

// Query to fetch ShiftLog and EquipmentHours for the current date
$shiftLogQuery = "SELECT * FROM ShiftLog WHERE Date = '$currentDate'";
$shiftLogResult = $conn->query($shiftLogQuery);

$equipmentHoursQuery = "SELECT * FROM EquipmentHours";
$equipmentHoursResult = $conn->query($equipmentHoursQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .print-btn { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .print-btn:hover { background-color: #45a049; }
    </style>
</head>
<body>

<h2>Shift Report for <?php echo $currentDate; ?></h2>

<h3>Shift Log</h3>
<table>
    <tr>
        <th>ShiftID</th>
        <th>Date</th>
        <th>SupervisorID</th>
        <th>Shift Type</th>
        <th>Hazard Report</th>
        <th>Coal Extract</th>
        <th>Operational Efficiency</th>
        <th>Equipment Uptime</th>
        <th>Pending Tasks</th>
    </tr>
    <?php while($row = $shiftLogResult->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['ShiftID']; ?></td>
        <td><?php echo $row['Date']; ?></td>
        <td><?php echo $row['SupervisorID']; ?></td>
        <td><?php echo $row['ShiftType']; ?></td>
        <td><?php echo $row['HazardReport']; ?></td>
        <td><?php echo $row['CoalExtract']; ?></td>
        <td><?php echo $row['OpEff']; ?></td>
        <td><?php echo $row['EquipUpTime']; ?></td>
        <td><?php echo $row['PendingTasks']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>Equipment Hours</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Total Hours</th>
        <th>Equipment Name</th>
    </tr>
    <?php while($row = $equipmentHoursResult->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['equipment_name']; ?></td>
        <td><?php echo $row['total_hours']; ?></td>
        <td><?php echo $row['status']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<button class="print-btn" onclick="window.print()">Print as PDF</button>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
