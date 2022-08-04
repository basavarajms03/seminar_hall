<?php

session_start();
include('./db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `bookings` b, `seminar_halls` s
WHERE b.seminar_hall_id = s.id AND b.id = $_GET[id]") or die(mysqli_error($con));
$seminar_hall_count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$images = explode(',', $row[11]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Seminar Hall Details</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./css/bootstrap.js"></script>
    <style>
        .avatar {
            width: 50px;
            border-radius: 50%;
            height: 50px;
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
                    <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin/">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./students/">Student Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./department/">Department Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Seminar</p>
                <p class="page-subTitle text-danger font-weight-bold">Seminar Details</p>
            </div>
            <div class="col-md-4 text-center">
                <p class="page-title font-weight-bold text-success m-0">Title: <?php echo $row[3]; ?></p>
                <p title="<?php echo $row[4]; ?>" class="page-subTitle text-truncate text-danger font-weight-bold">Sub Title: <?php echo $row[4]; ?></p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="row mt-3">
                    <div class="col-md-4">
                        <p class="text-title mb-1 font-weight-bold text-secondary">Organizer Name</p>
                        <p class="text-muted m-0"><?php echo $row[3]; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-title mb-1 font-weight-bold text-secondary">Event Type</p>
                        <p class="text-muted m-0"><?php echo $row[14]; ?></p>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if ($row[12]) {
                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-danger mb-1 font-weight-bold text-secondary">Cancellation Reason</p>
                                    <p class="text-danger m-0"><?php echo $row[12] ?></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <p class="text-title mb-1 font-weight-bold text-secondary">From</p>
                        <p class="text-muted m-0"><?php echo date_format(date_create($row[6]), "Y-m-d h:i A"); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-title mb-1 font-weight-bold text-secondary">To</p>
                        <p class="text-muted m-0"><?php echo date_format(date_create($row[7]), "Y-m-d h:i A"); ?></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <p class="text-title mb-1 font-weight-bold text-danger">Seminar Hall Name</p>
                        <p class="m-0 text-success font-weight-bold"><?php echo $row[16]; ?></p>
                    </div>
                    <?php
                    if ($row[14] === 'Guest Lecturer') {
                    ?>
                        <div class="col-md-4">
                            <p class="text-title mb-1 font-weight-bold text-danger">Guest Lecturer Name</p>
                            <p class="m-0 text-success font-weight-bold"><?php echo $row[8]; ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="text-title mb-1 font-weight-bold text-secondary">Description</p>
                        <p class="text-muted m-0"><?php echo $row[9]; ?></p>
                    </div>
                </div>
                <?php
                if ($row[11]) {
                ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p class="text-title mb-1 font-weight-bold text-secondary">Images</p>
                            <div class="image-thumbnails">
                                <?php
                                for ($i = 0; $i < count($images); $i++) {
                                    if (explode('.', $images[$i])[1] !== 'pdf') {
                                ?>
                                        <img class="uploaded-images" src="./<?php echo $images[$i]; ?>" alt="" />
                                    <?php
                                    } else { ?>
                                        <div>
                                            <embed src="./<?php echo $images[$i]; ?>" width="800px" height="2100px" />
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>