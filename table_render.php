<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sih-1645";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date
$currentDate = date("Y-m-d");

// Fetch shift logs for the current date
$query = "SELECT ShiftID, ShiftType, Date, CoalExtract,OpEff,EquipStatus, HazardReport 
          FROM ShiftLog WHERE Date = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $currentDate);
$stmt->execute();
$result = $stmt->get_result();

// Render table if there's data
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ShiftID</th>
                <th>ShiftType</th>
                <th>Date</th>
                <th>Coal Extracted (Tons)</th>
                <th>Operational Efficiency</th>
                <th>Equipment Status</th>
                <th>Hazard Report</th>
            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ShiftID"] . "</td>
                <td>" . $row["ShiftType"] . "</td>
                <td>" . $row["Date"] . "</td>
                <td>" . $row["CoalExtract"] . "</td>
                <td>" .$row["OpEff"] . "</td>
                <td>" . $row["EquipStatus"] . "</td>
                <td>" . $row["HazardReport"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No shift logs for today.";
}

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var currentHour = new Date().getHours();
    
    // Check if the current time is past midnight
    if (currentHour >= 0 && currentHour < 6) { // Hide table between midnight and 6 AM
      var table = document.querySelector("table");
      if (table) {
        table.style.display = "none";
      }
    }
  });
</script>

</body>
</html>