<?php
// Retrieve the date parameter sent from the client-side
$date = $_GET['date'];

// Query the database to fetch events for the specified date
// Example using MySQLi
$mysqli = new mysqli("localhost", "root", "earlot12", "student_system");
$sql = "SELECT event_note FROM events WHERE date = '$date'";
$result = $mysqli->query($sql);

// Format the events data (e.g., as HTML)
$eventListHTML = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventNote = $row['event_note'];
        $eventListHTML .= "<div>$eventNote</div>";
    }
} else {
    $eventListHTML = "<div>No events for this date</div>";
}

// Return the events data (HTML) to the client-side
echo $eventListHTML;
?>
