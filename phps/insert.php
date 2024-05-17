<?php
// Include database connection file
include("config.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $photo = $_POST['photo'];
    $organizer_id = $_POST['organizer_id'];

    // Prepare SQL statement to insert new event
    $sql = "INSERT INTO Events (name, date, time, description , type ,photo ,organiz_id) VALUES (?, ?, ?, ? ,? , ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $date, $time, $description ,$type ,$photo , $organizer_id);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Redirect to the page showing all events
        header("Location: admin.php");
        exit();
    } else {
        // If the insertion fails, display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
