<?php

include('./department_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, 'SELECT * FROM `seminar_halls`') or die(mysqli_error($con));
$seminar_hall_count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Seminar Hall</title>
    <style>
        table {
            table-layout: fixed;
        }

        td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th:not(:nth-child(2)),
        th:not(:nth-child(3)) {
            width: 10%;
        }

        th:nth-child(2) {
            width: 30%;
        }

        th:nth-child(3) {
            width: 40%;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Seminar Halls</p>
                <p class="page-subTitle text-danger font-weight-bold">Seminar Halls List</p>
            </div>
        </div>
        <div class="mt-4">
            <?php
            if ($seminar_hall_count === 0) {
            ?>
                <div class="text-center">
                    <img src="./../images/no-data.png" alt="No Data" width="300px">
                    <p class="text-muted font-weight-bold m-0">No seminar halls found</p>
                    <small class="text-danger font-weight-bold">Please contact administrator to create seminar halls.</small>
                </div>
            <?php
            } else {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-danger text-light">
                            <th scope="col">#</th>
                            <th scope="col">Seminar Hall Name</th>
                            <th scope="col">Seminar Hall Description</th>
                            <th scope="col">Book</th>
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
                                <td><?php echo $row[1]; ?></td>
                                <td>
                                    <p class="m-0" title="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></p>
                                </td>
                                <td><a href="./book_seminar_hall.php?id=<?php echo $row[0]; ?>" class="badge badge-success">Book</a></td>
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