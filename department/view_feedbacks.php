<?php

session_start();
include('./department_header.php');
include('../db/dbcon.php');

$rollNo = $_SESSION['userData'][1];
$feedback_query = "SELECT * FROM `feedback` f, `bookings` b, `students_list` s 
WHERE f.booking_id = b.id and f.student_id = s.roll_no and f.booking_id = $_GET[id]";
$feedback_result = mysqli_query($con, $feedback_query);
$feedback_count = mysqli_num_rows($feedback_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department - Feedbacks</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-4">
                <p class="page-title font-weight-bold text-success m-0">Feedbacks</p>
                <p class="page-subTitle text-danger font-weight-bold">Feedbacks List information</p>
            </div>
        </div>
        <div class="questions_list mt-3">
            <h3>Questions.</h3>
            <p>1. How helpful was the event?</p>
            <p>2. Did the event help you with new learnings or knowledge?</p>
            <p>3. The workshop content was relevent and easy to understand?</p>
            <p>4. The facilatators were well prepared and responsive to participants questions?</p>
            <p>5. The material was presented in an organized manner?</p>
        </div>
        <div class="mt-4">
            <?php
            if ($feedback_count === 0) {
            ?>
                <div class="text-center">
                    <img src="./../images/no-data.png" alt="No Data" width="300px">
                    <p class="text-muted font-weight-bold m-0">No Feedbacks found</p>
                    <small class="text-danger font-weight-bold">Create Feedbacks to display over here.</small>
                </div>
            <?php
            } else {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-danger text-light">
                            <th scope="col">#</th>
                            <th scope="col">Roll No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Question 1</th>
                            <th scope="col">Question 2</th>
                            <th scope="col">Question 3</th>
                            <th scope="col">Question 4</th>
                            <th scope="col">Question 5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        while ($row = mysqli_fetch_array($feedback_result)) {
                            $count = $count + 1;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo $row[25]; ?></td>
                                <td><?php echo $row[26] . ' ' . $row[27]; ?></td>
                                <td><?php echo $row[29]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td><?php echo $row[6]; ?></td>
                                <td><?php echo $row[7]; ?></td>
                                <td><?php echo $row[8]; ?></td>
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

<script>
    function onSelectSemester(event) {
        if (event.target.value) {
            document.location = "./students_list.php?sem=" + event.target.value;
        } else {
            document.location = "./students_list.php";
        }
    }
</script>