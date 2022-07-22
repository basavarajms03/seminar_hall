<?php

session_start();
include('./department_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `bookings` b, `seminar_halls` s
WHERE b.seminar_hall_id = s.id AND b.deptId = $_SESSION[deptId]") or die(mysqli_error($con));
$seminar_hall_count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Seminar Hall</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">My Bookings</p>
                <p class="page-subTitle text-danger font-weight-bold">My Bookings List</p>
            </div>
        </div>
        <div class="mt-4">
            <?php
            if ($seminar_hall_count === 0) {
            ?>
                <div class="text-center">
                    <img src="./../images/no-data.png" alt="No Data" width="300px">
                    <p class="text-muted font-weight-bold m-0">No seminar hall bookings found</p>
                    <small class="text-danger font-weight-bold">Book seminar hall to display over here.</small>
                </div>
            <?php
            } else {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-danger text-light">
                            <th scope="col">#</th>
                            <th scope="col">Seminar Hall Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">subject</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $count = $count + 1;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo $row[15]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo date_format(date_create($row[6]), "Y-m-d h:i A"); ?></td>
                                <td><?php echo date_format(date_create($row[7]), "Y-m-d h:i A"); ?></td>
                                <td><a href="./view_seminar_hall.php?id=<?php echo $row[0]; ?>" class="badge badge-success">View</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>