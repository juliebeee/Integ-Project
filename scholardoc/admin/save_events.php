<?php
// Ensure that the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve event note and date from the form submission
    $eventNote = $_POST['eventNote'];
    $eventDate = $_POST['eventDate'];

    try {
        // Database connection
        $pdo = new PDO("mysql:host=localhost;dbname=student_system", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if there is an existing event for the provided date
        $stmt = $pdo->prepare("SELECT MAX(event_id) AS max_id FROM calendarevents");
        $stmt->execute();
        $maxIdRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $maxIdRow['max_id'];

        // Insert a new event for the date
        $stmt = $pdo->prepare("INSERT INTO calendarevents (event_id, date, event_note) VALUES (:eventId, :eventDate, :eventNote)");
        $eventId = $maxId + 1; // Generate a new event_id
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':eventDate', $eventDate);
        $stmt->bindParam(':eventNote', $eventNote);
        $stmt->execute();

        // Close connection
        $pdo = null;

        // Reset the event_id values to ensure sequential order
        $pdo = new PDO("mysql:host=localhost;dbname=student_system", "root", "");
        $stmt = $pdo->prepare("SET @counter = 0;");
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE calendarevents SET event_id = @counter := @counter + 1;");
        $stmt->execute();
        
        // Debugging: Check if the script reaches this point
        echo "Event saved successfully.";

        // Redirect back to the page where the form was submitted
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } catch (PDOException $e) {
        // Handle database error
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
?>
