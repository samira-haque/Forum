<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <title>Coding Forum</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <!-- Carousel -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="Photos/2.webp" alt="First slide"
                    style="width:2400px; height:400px; object-fit:cover;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="Photos/3.webp" alt="Second slide"
                    style="width:2400px; height:400px; object-fit:cover;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="Photos/4.webp" alt="Third slide"
                    style="width:2400px; height:400px; object-fit:cover;">
            </div>
        </div>
    </div>

    <!-- Browse Categories -->
    <div class="container my-3">
        <h2 class="text-center my-3">Browse Categories</h2>
        <div class="row my-3">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                echo '
                <div class="col-md-4 my-2">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="Photos/1.webp" alt="' . $cat . ' image">
                        <div class="card-body">
                            <h5 class="card-title">' . $cat . '</h5>
                            <p class="card-text">' . substr($desc, 0, 80) . '...</p>
                            <a href="#" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <?php include 'partials/_footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
