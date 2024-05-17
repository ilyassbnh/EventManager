<!-- add_event_form.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Event</title>
</head>

<body>
    <h2>Add New Event</h2>
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <label for="name">Event Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br><br>

        <label for="time">Time:</label><br>
        <input type="time" id="time" name="time" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="type">Type:</label><br>
        <input type="text" id="type" name="type" required><br><br>

        <label for="photo">Photo URL:</label><br>
        <input type="text" id="photo" name="photo" required><br><br>

        <label for="organizer_id">Organizer ID:</label><br>
        <input type="text" id="organizer_id" name="organizer_id" required><br><br>

        <input type="submit" value="Add Event">
    </form>
</body>

</html>
