<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the year from the GET request
$year = $_GET['year'];

// Determine the correct table based on the year
$table = "";
if ($year == '2nd') {
    $table = 'secondyear';
} elseif ($year == '3rd') {
    $table = 'thirdyear';
} elseif ($year == '4th') {
    $table = 'fourthyear';
}

// Fetch data from the corresponding table
$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-year='$year'>";
        echo "<td>" . $row["full_name"] . "</td>";

        // Dropdown menu for the first semester midterm
        $key1stMidterm = $row["id"] . "_1st_midterm"; // Generate unique key
        echo "<td><select name='1st_midterm_status' data-key='" . $key1stMidterm . "' data-id='" . $row["id"] . "' data-year='$year' onchange='handleDropdownChange(this)'>";
        echo "<option value=''>Select</option>";
        echo "<option value='Pending'>Pending</option>";
        echo "<option value='Received'>Received</option>";
        echo "<option value='On Hold'>On Hold</option>";
        echo "</select></td>";

        // Dropdown menu for the first semester final term
        $key1stFinal = $row["id"] . "_1st_final"; // Generate unique key
        echo "<td><select name='1st_final_status' data-key='" . $key1stFinal . "' data-id='" . $row["id"] . "' data-year='$year' onchange='handleDropdownChange(this)'>";
        echo "<option value=''>Select</option>";
        echo "<option value='Pending'>Pending</option>";
        echo "<option value='Received'>Received</option>";
        echo "<option value='On Hold'>On Hold</option>";
        echo "</select></td>";

        // Dropdown menu for the second semester midterm
        $key2ndMidterm = $row["id"] . "_2nd_midterm"; // Generate unique key
        echo "<td><select name='2nd_midterm_status' data-key='" . $key2ndMidterm . "' data-id='" . $row["id"] . "' data-year='$year' onchange='handleDropdownChange(this)'>";
        echo "<option value=''>Select</option>";
        echo "<option value='Pending'>Pending</option>";
        echo "<option value='Received'>Received</option>";
        echo "<option value='On Hold'>On Hold</option>";
        echo "</select></td>";

        // Dropdown menu for the second semester final term
        $key2ndFinal = $row["id"] . "_2nd_final"; // Generate unique key
        echo "<td><select name='2nd_final_status' data-key='" . $key2ndFinal . "' data-id='" . $row["id"] . "' data-year='$year' onchange='handleDropdownChange(this)'>";
        echo "<option value=''>Select</option>";
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
