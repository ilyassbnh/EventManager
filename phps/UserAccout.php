<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .actions a {
            text-decoration: none;
            color: #333;
            margin-right: 10px;
        }
        .actions a:hover {
            color: blue;
        }
    </style>
</head>
<body>
    <h2>Event Management</h2>

    <!-- Display events in a table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include the database configuration file
            include("config.php");

            // Retrieve events from the database
            $sql = "SELECT * FROM Events";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["type"]."</td>";
                    echo "<td>".$row["date"]."</td>";
                    echo "<td>".$row["time"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    echo "<td class='actions'><a href='edit_event.php?id=".$row["id"]."'>Edit</a> | <a href='delete_event.php?id=".$row["id"]."'>Remove</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No events found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <p><a href="add_event.php">Add New Event</a></p>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
