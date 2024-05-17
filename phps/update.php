<?php
// Include the database configuration file
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['description'];

    // Prepare and execute SQL query to update the event details
    $sql = "UPDATE Events SET name = ?, type = ?, date = ?, time = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $type, $date, $time, $description, $event_id);

    if ($stmt->execute()) {
        // Redirect back to the page where you view the list of events
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating event: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
