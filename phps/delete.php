<?php
// Include the database configuration file
include("config.php");

if (isset($_GET['id'])) {
    // Retrieve the event ID from the POST data
    $event_id = $_GET['id'];

    // Prepare and execute SQL query to delete the event
    $sql = "DELETE FROM Events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        // Redirect back to the page where you view the list of events
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting event: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}
// Close database connection
$conn->close();
?>
