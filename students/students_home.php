<?php

include('../db/dbcon.php');
include('./students_header.php');

$todayDate = Date('Y-m-d');
$result = mysqli_query($con, "SELECT * FROM `bookings` b, `departments` d, `seminar_halls` s
          WHERE b.deptId = d.deptId and b.seminar_hall_id = s.id and b.from_date >= '$todayDate'") or die(mysqli_error($con));
$count = mysqli_num_rows($result);


$completed_result = mysqli_query($con, "SELECT * FROM `bookings` b, `departments` d, `seminar_halls` s
          WHERE b.deptId = d.deptId and b.seminar_hall_id = s.id and b.from_date <= '$todayDate'") or die(mysqli_error($con));
$completed_count = mysqli_num_rows($completed_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="mt-5 mb-5" id="upcoming_seminars">
            <h5 class="font-weight-bold text-black">Completed Seminars</h5>
            <?php
            if ($completed_count === 0) {
            ?>
                <div class="text-center">
                    <img src="../images/no-data.png" alt="No Data" width="300px">
                    <p class="text-muted font-weight-bold m-0">No seminar hall bookings found</p>
                    <small class="text-danger font-weight-bold">Book seminar hall to display over here.</small>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($completed_result)) {
                    ?>

                        <div class="col-md-4 mt-3">
                            <div class="card">
                                <div class="card-header font-weight-bold text-success">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php echo $row[19]; ?> <?php echo $row[8] ? '- ' . $row[8] : ''; ?>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="./feedback.php?id=<?php echo $row[0]; ?>" class="badge badge-primary">Student Feedback</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-0"><?php echo $row[3]; ?></h5>
                                    <small class="card-subtitle font-weight-bold text-muted"><?php echo $row[4]; ?></small><br>
                                    <small class="card-subtitle font-weight-bold text-danger"><?php echo date_format(date_create($row[6]), "Y-m-d h:i A"); ?> - <?php echo date_format(date_create($row[7]), "Y-m-d h:i A"); ?></small>
                                    <p><small class="card-subtitle font-weight-bold text-warning"><?php echo $row[17]; ?> - <?php echo $row[14]; ?></small></p>
                                    <p class="card-text mt-3"><?php echo $row[9]; ?></p>
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
        <div class="mt-5 mb-5" id="upcoming_seminars">
            <h5 class="font-weight-bold text-black">Upcoming Seminars</h5>
            <?php
            if ($count === 0) {
            ?>
                <div class="text-center">
                    <img src="../images/no-data.png" alt="No Data" width="300px">
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
                                    <?php echo $row[19]; ?> <?php echo $row[8] ? '- ' . $row[8] : ''; ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-0"><?php echo $row[3]; ?></h5>
                                    <small class="card-subtitle font-weight-bold text-muted"><?php echo $row[4]; ?></small><br>
                                    <small class="card-subtitle font-weight-bold text-danger"><?php echo date_format(date_create($row[6]), "Y-m-d h:i A"); ?> - <?php echo date_format(date_create($row[7]), "Y-m-d h:i A"); ?></small>
                                    <p><small class="card-subtitle font-weight-bold text-warning"><?php echo $row[17]; ?> - <?php echo $row[14]; ?></small></p>
                                    <p class="card-text mt-3"><?php echo $row[9]; ?></p>
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