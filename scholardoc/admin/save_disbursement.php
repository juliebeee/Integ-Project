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

// Get data from POST request
$student_id = $_POST['student_id'];
$year = $_POST['year'];
$column = $_POST['column'];
$value = $_POST['value'];

// Determine the correct table based on the year
$table = "";
if ($year == '2nd') {
    $table = 'secondyear';
} elseif ($year == '3rd') {
    $table = 'thirdyear';
} elseif ($year == '4th') {
    $table = 'fourthyear';
}

// Update the corresponding column in the database
$sql = "UPDATE $table SET $column = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $value, $student_id);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
