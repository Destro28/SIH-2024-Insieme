<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $location = htmlspecialchars($_POST['hazard-location']);
    $risk = htmlspecialchars($_POST['hazard-risk']);
    $reportedBy = htmlspecialchars($_POST['hazard-reported']);
    $witnessName = htmlspecialchars($_POST['hazard-name']);
    $description = htmlspecialchars($_POST['hazard-description']);
    $additionalInfo = htmlspecialchars($_POST['additonal-info']);
    
    // Get current timestamp
    $timestamp = date('Y-m-d H:i:s');

    // Create or open file
    $file = fopen('submissions.txt', 'a');
    
    // Save data to file
    fwrite($file, "$timestamp | Location: $location | Risk: $risk | Reported By: $reportedBy | Witness: $witnessName | Description: $description | Additional Info: $additionalInfo\n");
    
    // Close file
    fclose($file);

    // Redirect to index.html
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/shift_details.css">
    
    
    
    <title>Shift Log</title>
</head>
<style>
        /* Style the collapsible button */
.collapsible {
    background-color: #ffffff;
    color: black;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 18px;
  }

form {
  max-width: 500px;
  margin: 0 auto;
}
.progress-bar {
  width: 100%;
  background-color: #e0e0e0;
  border-radius: 5px;
  overflow: hidden;
  height: 20px;
  margin-bottom: 20px;
}
.progress {
  height: 100%;
  background-color: #4caf50;
  width: 0%;
  transition: width 0.3s ease-in-out;
}
.collapsible:hover {
  background-color: #ddd;
}
/* Style the collapsible content (hidden by default) */
.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f9f9f9;
  margin-bottom: 10px;
}
</style>
<body>

    <h1>Shift Handover Form</h1>
    <div class="progress-bar">
        <div class="progress" id="progress"></div>
      </div>

    <form action="../backend/handover_logs.php" method="post" id="myForm">
      <!-- Shift type shiftdate -->
        <button class="collapsible">Shift Details</button>
        <div class="content">
            <label for="ShiftDate">Date: </label><br>
            <input type="date" id="shiftdate" name="shiftdate" required><br><br><br>
            <label for="ShiftType">Shift Type: </label> <br>
            <select id="shiftType" name="shiftType">
                <option value="day">Morning</option>
                <option value="afternoon">Afternoon</option>
                <option value="evening">Evening</option>
                <option value="night">Night</option>
              </select><br><br>
            <!-- lets keep 3 types of shift type: Morning Afternoon Evening and Night -->
        </div> 

        <!-- Hazard Report-->
        <button class="collapsible">Hazard Reports</button>
        <div class="content">
            <label for="hazardReport">Describe any hazards:</label><br>
            <textarea id="hazardReport" name="hazardReport" rows="4" cols="50" required></textarea><br><br>
        </div>


          <!-- coalextract,EquipUpTime,OpEff -->
        <button class="collapsible">Production  Details</button>
        <div class="content">
          <label for="coalextract">Amount of Coal Extracted (in tons):</label><br>
            <input type="number" id="coalextract" name="coalextract"><br><br>
            <label for="EquipUptime">Equipment Up Time(set amount of equipment is assumed): </label><br>
            <input type="number" id="EquipUptime" name="EquipUptime">  <br><br>
            
            <label for="OpEff">Operational Efficiency: </label><br>
            <input type="number" id="OpEff" name="OpEff">      
        </div>

        <!-- Collapsible Tab 4 -->
        <button class="collapsible">Equipment Status</button>
        <div class="content">
          <label for="equipmentStatus">Equipment Status:</label><br>
          <textarea id="equipmentStatus" name="equipmentStatus" rows="4" cols="50" required></textarea><br><br>
        </div>



        <!-- Collapsible Tab 5 -->
        <button class="collapsible">Pending Tasks</button>
        <div class="content">
          <label for="pendingTasks">Pending Tasks:</label><br>
          <textarea id="pendingTasks" name="pendingTasks" rows="4" cols="50" required></textarea><br><br>
        </div>

        <!-- Collapsible Tab 5 -->





        <div class="Submit">
            <input type="submit" value="Submit">
        </div>
    </form>
    <script  src="../jss/shift_details.js"></script>
</body>
</html>

<script>
    var coll = document.getElementsByClassName("collapsible");
for (var i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });

}

const form = document.getElementById('myForm');
const progressBar = document.getElementById('progress');

form.addEventListener('input', updateProgressBar);

function updateProgressBar() {
  const formElements = Array.from(form.elements).filter(el => el.type !== 'submit');
  const totalFields = formElements.length;
  let filledFields = formElements.filter(el => el.value.trim() !== '').length;

  // Calculate progress percentage
  const progressPercentage = (filledFields / totalFields) * 100;
  progressBar.style.width = progressPercentage + '%';
}
</script>
