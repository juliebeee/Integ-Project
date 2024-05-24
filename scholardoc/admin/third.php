<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Grades Table</title>
<style>
    body {
      font-family: 'Courier New', Courier, monospace;
      background-color: #F6EAC6;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      position: relative;
    }

    .admin-dashboard {
      position: absolute;
      top: 0;
      left: 0; /* Change left position to 0 */
      right: 0; /* Change right position to 0 */
      font-size: 24px;
      color: #3C2621;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
      font-family: Broadway;
      font-weight: bold;
      font-size: 50px;
      text-align: center;
      top: 0;
      left: 0;
      right: 0;
      margin: auto;
      width: 100%;
      background-color: #F4E1AB;
      padding: 40px 0;
      z-index: 1;
      transition: transform 0.3s ease;
    }

    h2 {
      color: #3C2621;
      text-align: center;
      margin-top: 50px;
      font-family: 'Courier New', Courier, monospace;
      font-size: 20px;
    }

    table {
      border-collapse: collapse;
      width: 80%;
      background-color: #F4E1AB;
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      border: 1px solid #3C2621;
      text-align: center;
      padding: 8px;
      color: #333;
    }

    th {
      background-color: #D0A074;
    }

    tr:nth-child(even) {
      background-color:  #fff; /* White background */
    }

    tr:nth-child(odd) {
      background-color: #f2f2f2;
    }

    .year-buttons {
      margin-bottom: 20px;
    }

    .year-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #D0A074;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-right: 10px;
      font-family: 'Courier New', Courier, monospace;
    }

    .year-button:hover {
      background-color: #A52A2A;
      cursor: pointer;
      transform: scale(1.1);
    }

    /* Style for active button */
    .active {
      background-color: #A52A2A !important;
      color: #fff !important;
    }

    .back-button {
      margin-top: 20px;
      background-color: #D0A074;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;
      font-family: 'Courier New', Courier, monospace;
    }

    .back-button:hover {
      background-color: #A52A2A;
      cursor: pointer;
      transform: scale(1.1);
    }
</style>
</head>
<body>

  <!-- Admin Dashboard -->
  <header class="admin-dashboard">
    <h1>Admin Dashboard</h1>
  </header>

  <!-- Header -->
  <h2>Disbursement Table</h2>

  <!-- Year Selection Buttons -->
<div class="year-buttons">
  <button class="year-button" onclick="loadData('2nd')">2nd Year</button>
  <button class="year-button active" onclick="loadData('3rd')">3rd Year</button>
  <button class="year-button" onclick="loadData('4th')">4th Year</button>
</div>

<table id="disbursement-table">
  <thead>
    <tr>
      <th rowspan="2">Name</th>
      <th colspan="2">1st Semester</th>
      <th colspan="2">2nd Semester</th>
    </tr>
    <tr>
      <th>Midterm</th>
      <th>Final Term</th>
      <th>Midterm</th>
      <th>Final Term</th>
    </tr>
  </thead>
  <tbody>
    <?php

     // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "earlot12";
  $dbname = "student_system";

    // Connect to your database
    $conn = new mysqli('localhost', 'root', 'earlot12', 'student_system');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT * FROM thirdyear";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["full_name"] . "</td>";

            // Dropdown menu for the first semester midterm
              echo "<td><select name='1st_midterm'>";
              echo "<option value=''>Select</option>"; // No default value
              echo "<option value='Pending'>Pending</option>";
              echo "<option value='Received'>Received</option>";
              echo "<option value='On Hold'>On Hold</option>";
              echo "</select></td>";
              
              // Dropdown menu for the first semester final term
              echo "<td><select name='1st_final'>";
              echo "<option value=''>Select</option>"; // No default value
              echo "<option value='Pending'>Pending</option>";
              echo "<option value='Received'>Received</option>";
              echo "<option value='On Hold'>On Hold</option>";
              echo "</select></td>";
              
              // Dropdown menu for the second semester midterm
              echo "<td><select name='2nd_midterm'>";
              echo "<option value=''>Select</option>"; // No default value
              echo "<option value='Pending'>Pending</option>";
              echo "<option value='Received'>Received</option>";
              echo "<option value='On Hold'>On Hold</option>";
              echo "</select></td>";
              
              // Dropdown menu for the second semester final term
              echo "<td><select name='2nd_final'>";
              echo "<option value=''>Select</option>"; // No default value
              echo "<option value='Pending'>Pending</option>";
              echo "<option value='Received'>Received</option>";
              echo "<option value='On Hold'>On Hold</option>";
              echo "</select></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
    }

    // Close connection
    $conn->close();
    ?>
  </tbody>
</table>

<!-- Back Button -->
<button class="back-button" onclick="goBack()">Back</button>

<script>
  // Function to navigate back to the admin_dashboard.html page
    function goBack() {
      window.location.href = 'admin_dashboard.html';
    }

  // Function to load data for a specific year
  function loadData(year) {
    if (year === '2nd') {
      window.location.href = 'disbursements.php';
    } else if (year === '3rd') {
      // Handle data loading for 3rd year
    } else if (year === '4th') {
      window.location.href = 'fourth.php';
    }
  }
</script>

</body>
</html>
