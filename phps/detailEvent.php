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
  <nav class="navbar navbar-expand-lg bg-body-tertiary" sticky>
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
            <a class="nav-link active" aria-current="page" href="gestionEvent.php">Gestion event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="UserAccout.php">User Account</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- card detail  -->
  <?php
  include("config.php");

  // Check if event ID is provided in the URL
  if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch event details based on the provided event ID
    $sql = "SELECT * FROM Events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
      <div class="card" style="width: 60rem;">
        <img src="<?php echo $row["photo"]; ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $row["name"]; ?></h5>
          <p class="card-text"><strong>Date:</strong> <?php echo $row["date"]; ?></p>
          <p class="card-text"><strong>Time:</strong> <?php echo $row["time"]; ?></p>
          <p class="card-text"><strong>Description:</strong> <?php echo $row["description"]; ?></p>
          <!-- Add more details here -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">inscrire</button>
        </div>
      </div>
  <?php
    } else {
      echo "Event not found.";
    }
  } else {
    echo "Event ID not provided.";
  }
  ?>

  <!-- Modal for participant information -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Participant Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="participantForm" method="post" action="email.php">
            <div class="mb-3">
              <label for="participant-name" class="col-form-label">Your Name:</label>
              <input type="text" class="form-control" id="participant-name" name="participant-name" required>
            </div>
            <div class="mb-3">
              <label for="participant-email" class="col-form-label">Your Email:</label>
              <input type="email" class="form-control" id="participant-email" name="participant-email" required>
            </div>
            <div class="mb-3">
              <label for="participant-phone" class="col-form-label">Your Phone Number:</label>
              <input type="text" class="form-control" id="participant-phone" name="participant-phone" required>
            </div>
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="participantForm">Send message</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
