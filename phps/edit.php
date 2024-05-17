<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>
    <h2>Edit Event</h2>

    <?php
    // Include the database configuration file
    include("config.php");

    // Check if event ID is provided in the URL
    if (isset($_GET['id'])) {
        $event_id = $_GET['id'];

        // Fetch event details based on the provided event ID
        $sql = "SELECT * FROM Events WHERE id = $event_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <!-- Display event details in a form for editing -->
            <form action="update.php" method="post">
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br><br>
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="<?php echo $row['type']; ?>"><br><br>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>"><br><br>
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" value="<?php echo $row['time']; ?>"><br><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" cols="50"><?php echo $row['description']; ?></textarea><br><br>
                <input type="submit" value="Save Changes">
            </form>
    <?php
        } else {
            echo "Event not found.";
        }
    } else {
        echo "Event ID not provided.";
    }
    $conn->close();
    ?>
</body>
</html>
