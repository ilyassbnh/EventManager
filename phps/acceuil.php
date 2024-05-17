<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <title>detail event</title>
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
                        <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="GET" action="acceuil.php">
                    <input class="form-control me-2" type="search" placeholder="Search by event type" aria-label="Search" name="type">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- carousel -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/sash-presents-half-baked-part-one-tripmastaz-sam-bangura-saturday-april-20th-1712289797986-desktop.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/images.jpg" class="d-block w-100 " alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/images.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- cards -->
    <div class="cards">
        <?php
        include("config.php");

        include("config.php");

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['type'])) {
            $type = $_GET['type'];
            $sql = "SELECT id, photo, name, type FROM Events WHERE type='$type'";
        } else {
            $sql = "SELECT id, photo, name, type FROM Events";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card" style="width: 18rem;">';
                echo '<img src="' . $row["photo"] . '" class="card-img-top" alt="...">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                echo '<p class="card-type">' . $row["type"] . '</p>';
                echo '<a href="detailEvent.php?event_id=' . $row["id"] . '" class="btn btn-primary">Event Detail</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>

    <footer>
        <div class="bg-zinc-900 text-white py-4 px-1 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="footer">
                <div>
                    <h3 class="text-lg font-bold mb-2">Links</h3>
                    <ul>
                        <li><a href="#" class="hover:underline">Home</a></li>
                        <li><a href="#" class="hover:underline">About</a></li>
                        <li><a href="#" class="hover:underline">Services</a></li>
                        <li><a href="#" class="hover:underline">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-2">About</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-2">Social Media</h3>
                    <div class="flex space-x-4">
                        <a href="#"><img src="https://placehold.co/30" alt="Facebook"></a>
                        <a href="#"><img src="https://placehold.co/30" alt="Twitter"></a>
                        <a href="#"><img src="https://placehold.co/30" alt="Instagram"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
