<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve event date and note from the request
    $eventDate = $_POST['eventDate'];
    $eventNote = $_POST['eventNote'];

    try {
        // Database connection
        $pdo = new PDO("mysql:host=localhost;dbname=student_system", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Begin transaction to ensure consistency
        $pdo->beginTransaction();

        // Prepare and execute SQL query to delete the event
        $stmt = $pdo->prepare("DELETE FROM calendarevents WHERE date = :eventDate AND event_note = :eventNote");
        $stmt->bindParam(':eventDate', $eventDate);
        $stmt->bindParam(':eventNote', $eventNote);
        $stmt->execute();

        // Reset the event_id values to ensure sequential order
        $stmt = $pdo->prepare("SET @counter = 0;");
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE calendarevents SET event_id = @counter := @counter + 1;");
        $stmt->execute();

        // Commit transaction
        $pdo->commit();

        // Close connection
        $pdo = null;

        // Send a success response
        http_response_code(200);
        echo "Event deleted successfully from the database.";
    } catch (PDOException $e) {
        // Roll back transaction on error
        $pdo->rollBack();

        // Handle database error
        http_response_code(500);
        echo "Error: " . $e->getMessage();
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo "Invalid request method.";
}
?>
