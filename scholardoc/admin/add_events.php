<?php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the POST data (date and event)
    $postData = json_decode(file_get_contents("php://input"), true);

    // Check if the POST data is valid
    if (isset($postData['date']) && isset($postData['description'])) {
        // Extract date and description from POST data
        $date = $postData['date'];
        $description = $postData['description'];

        // Database connection parameters
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

        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO events (date, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $date, $description);

        // Execute the statement
        if ($stmt->execute()) {
            // Event added successfully
            $response = ['success' => true, 'message' => 'Event added successfully'];
            echo json_encode($response);
        } else {
            // Failed to add event
            $response = ['success' => false, 'error' => 'Failed to add event'];
            echo json_encode($response);
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Send error response if POST data is incomplete
        $response = ['success' => false, 'error' => 'Incomplete data'];
        echo json_encode($response);
    }
} else {
    // Send error response if request method is not POST
    $response = ['success' => false, 'error' => 'Invalid request method'];
    echo json_encode($response);
}
?>
