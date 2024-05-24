<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_system";

// Connect to your database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve student_id_no from session
if (!isset($_SESSION['student_id_no'])) {
    die("No student ID found in session.");
}
$student_id_no = $_SESSION['student_id_no'];

// Function to determine the table name based on the student_id_no
function getStudentYearTable($conn, $student_id_no) {
    $tables = ['secondyear', 'thirdyear', 'fourthyear'];
    foreach ($tables as $table) {
        $sql = "SELECT student_id_no FROM $table WHERE student_id_no = '$student_id_no'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            return $table;
        }
    }
    return null;
}

$tableName = getStudentYearTable($conn, $student_id_no);
if (!$tableName) {
    die("Student not found in any year table.");
}

// Initialize notification message
$notificationMessage = "";

// Handle file uploads for each column
for ($i = 0; $i < 6; $i++) {
    $fileColumnName = "file_" . $i;

    // Check if the file has been uploaded
    if (isset($_FILES[$fileColumnName]) && $_FILES[$fileColumnName]["error"] == 0) {
        $fileName = basename($_FILES[$fileColumnName]["name"]);
        $targetDir = "C:/xampp/htdocs/scholardoc/student/fileupload/";
        $targetPath = $targetDir . $fileName;

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES[$fileColumnName]["tmp_name"], $targetPath)) {
            // Insert file details into the corresponding table and column
            $sql = "UPDATE $tableName SET $fileColumnName = '$targetPath' WHERE student_id_no = '$student_id_no'";
            if ($conn->query($sql) === TRUE) {
                // Append notification message
                $notificationMessage .= "File uploaded and saved to DB for column: $fileColumnName<br>";
            } else {
                $notificationMessage .= "Error: " . $sql . " Error Details: " . $conn->error . "<br>";
            }
        } else {
            $notificationMessage .= "Error Moving the file for column: $fileColumnName<br>";
        }
    }
}

// Display notification message
echo $notificationMessage;

// Close connection
$conn->close();
?>
