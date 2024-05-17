<?php
// Include the database configuration file
include("config.php");

// Initialize search query variable
$searchQuery = "";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    // Sanitize and store the search query
    $searchQuery = htmlspecialchars($_GET['search']);

    // Construct SQL query to search for events
    $sql = "SELECT * FROM Events WHERE name LIKE '%$searchQuery%' OR type LIKE '%$searchQuery%' OR date LIKE '%$searchQuery%' OR time LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
} else {
    // If no search query, retrieve all events
    $sql = "SELECT * FROM Events";
}

// Retrieve events based on the constructed SQL query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" sticky >
        <div class="container-fluid">
          <a class="navbar-brand" href="#">EventManager</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="acceuil.php">Acceuil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="detailEvent.php">Detail event</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
              </li>
            </ul>
            <form class="d-flex" role="search" method="GET">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo $searchQuery; ?>">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

    <h2>Event Management</h2>

    <!-- Display events in a table -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Date</th>
            <th>Time</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["type"]."</td>";
                echo "<td>".$row["date"]."</td>";
                echo "<td>".$row["time"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "<td><a href='edit.php?id=".$row["id"]."'>Edit</a> | <a href='delete.php?id=".$row["id"]."'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No events found</td></tr>";
        }
        ?>
    </table>

    <p><a href="add.php">Add New Event</a></p>
<?php
// Close database connection
$conn->close();
?>

</body>
</html>
