<?php

include('./db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `bookings` b, `departments` d, `seminar_halls` s
          WHERE b.deptId = d.deptId and b.seminar_hall_id = s.id") or die(mysqli_error($con));
$count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./css/bootstrap.js"></script>
    <title>Home</title>

    <style>
        * {
            scroll-behavior: smooth;
        }

        .card-text {
            height: 100px;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold" href="#">Seminar Hall</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php#seminars">Seminars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin/index.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./department/index.php">Department Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/slider/1.jpg" alt="Los Angeles" class="d-block slider-img" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="./images/slider/2.jpg" alt="Chicago" class="d-block slider-img" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="./images/slider/3.jpg" alt="New York" class="d-block slider-img" style="width:100%">
            </div>
        </div>
    </div>
    <div class="mt-5 container" id="about">
        <h4 class="text-center font-weight-bold text-black">About</h4>
        <div class="row">
            <div class="col-md-6">
                <img src="./images/about.png" width="100%">
            </div>
            <div class="col-md-6 p-5">
                Lorem ipsum dolor sit amet. Aut alias magni sed nobis hic aliquid exercitationem.
                Sed amet exercitationem ea perspiciatis nihil ea blanditiis molestias ut maxime labore
                et eius Quis aut libero adipisci sed corporis tempora. Non officiis alias At itaque provident
                in repellendus ipsum non dolor earum eum dolor internos qui voluptas facilis eum omnis amet.
                Vel aperiam voluptas rem facilis error ut repellendus pariatur qui labore
                voluptatum qui reiciendis provident sed commodi esse et impedit adipisci. Sed reiciendis alias ut
                natus voluptates et quia doloribus?
                Aut quia quia rem dolorum sint vel omnis eligendi
                a quia accusantium qui deserunt nihil vel officiis quis id reprehenderit consequatur.
                Et nihil maxime sit aliquid deleniti non natus fuga eum omnis consequatur et unde corrupti
                est obcaecati tempore nam debitis rerum.
            </div>
        </div>
        <div class="mt-5 mb-5" id="seminars">
            <h4 class="text-center font-weight-bold text-black">Seminars</h4>
            <?php
            if ($count === 0) {
            ?>
                <div class="text-center">
                    <img src="./../images/no-data.png" alt="No Data" width="300px">
                    <p class="text-muted font-weight-bold m-0">No seminar hall bookings found</p>
                    <small class="text-danger font-weight-bold">Book seminar hall to display over here.</small>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <div class="col-md-4 mt-3">
                            <div class="card">
                                <div class="card-header font-weight-bold text-success">
                                    <?php echo $row[17]; ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-0"><?php echo $row[3]; ?></h5>
                                    <small class="card-subtitle font-weight-bold text-muted"><?php echo $row[4]; ?></small><br>
                                    <small class="card-subtitle font-weight-bold text-danger"><?php echo $row[6]; ?> - <?php echo $row[7]; ?></small>
                                    <p class="card-text mt-3"><?php echo $row[9]; ?></p>
                                    <p class="text-right m-0">
                                        <a href="./students/feedback.php?id=<?php echo $row[0]; ?>" class="btn btn-sm btn-primary">Student Feedback</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>