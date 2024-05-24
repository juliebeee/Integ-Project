<?php
// Connect to your database
$mysqli = new mysqli('localhost', 'root', '', 'student_system');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Query to fetch events from the database grouped by date
$sql = "SELECT date, GROUP_CONCAT(event_note SEPARATOR ';') AS event_notes FROM calendarevents GROUP BY date";

$result = $mysqli->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    $events = array();
    while ($row = $result->fetch_assoc()) {
        $events[$row['date']] = explode(';', $row['event_notes']);
    }
    
    // Convert array to JSON and output it
    echo json_encode($events);
} else {
    // If no events are found, return an empty array
    echo json_encode(array());
}

// Close database connection
$mysqli->close();
?>
