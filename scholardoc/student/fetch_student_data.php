<?php
session_start();

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

// Assuming the student's ID is stored in the session
$student_id_no = $_SESSION['student_id_no'];

// Flag to track if any data was found
$data_found = false;

// Fetch data from the corresponding table for the logged-in student
$tables = ["secondyear", "thirdyear", "fourthyear"];

foreach ($tables as $table) {
    // Fetch data from the current table for the logged-in student
    $sql = "SELECT 1st_midterm_status, 1st_final_status, 2nd_midterm_status, 2nd_final_status FROM $table WHERE student_id_no = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("s", $student_id_no);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $result = $stmt->get_result();
    if (!$result) {
        die("Get result failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    // Display data in the HTML table if data is found
    if ($result->num_rows > 0) {
        $data_found = true; // Set flag to true if data is found
        $row = $result->fetch_assoc();
        echo "<tr><td rowspan='2'>First</td><td>Midterm</td><td>" . $row['1st_midterm_status'] . "</td></tr>";
        echo "<tr><td>Final Term</td><td>" . $row['1st_final_status'] . "</td></tr>";
        echo "<tr><td rowspan='2'>Second</td><td>Midterm</td><td>" . $row['2nd_midterm_status'] . "</td></tr>";
        echo "<tr><td>Final Term</td><td>" . $row['2nd_final_status'] . "</td></tr>";
    }
}

// Display message if no data found for any table
if (!$data_found) {
    echo "<tr><td colspan='3'>No data found for any year.</td></tr>";
}

// Close the database connection
$conn->close();
?>
