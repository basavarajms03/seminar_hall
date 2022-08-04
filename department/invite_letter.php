<?php

session_start();
include('./department_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `bookings` b, `seminar_halls` s
WHERE b.seminar_hall_id = s.id AND b.id = $_GET[id]") or die(mysqli_error($con));
$seminar_hall_count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$images = explode(',', $row[11]);


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
    <title>Department - Booking Deatils</title>
    <style>
        .avatar {
            width: 50px;
            border-radius: 50%;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="col-md-12 mx-auto">
            <div class="row">
                <div class="col-md-2">
                    <img src="../images/1568389948615.jpg" width="100%" />
                </div>
                <div class="col-md-10 mt-3 text-center">
                    <h1 class="font-weight-bold text-success">T.M.A.E.S Polytechnic College</h1>
                    <h2 class="font-weight-bold text-danger">Bellary Road Hospet, Karnataka-583201</h2>
                    <h3 class="font-weight-bold text-muted">Ph: 08394 266211 email: tmaesp_hpt@yahoo.co.in</h3>
                </div>
            </div>
        </div>
        <hr style="height:2px;background:black">
        <div class="row">
            <div class="col-md-6">
                <p class="font-weight-bold">Number: TMAES/PH</p>
            </div>
            <div class="col-md-6 text-right">
                <p class="font-weight-bold">Date: <?php echo date('Y.m.d'); ?></p>
            </div>
        </div>
        <div class="mt-3">
            <p class="mb-0">To,</p>
            <p class="font-weight-bold"><?php echo $row[8]; ?></p>
        </div>
        <div class="mt-3">
            <p>Sir,</p>
            <p class="font-weight-bold">Sub: Invite For <?php echo $row[3]; ?> - Requested</p>
            <p>With reference to the above subject, we are honored and pleased to invite you to
                our institution to give presentation on <span class="font-weight-bold"><?php echo $row[3]; ?></span> for our diploma in <?php echo  $_SESSION['userData'][2]; ?> and Engineering
                students on <span class="font-weight-bold"><?php echo date_format(date_create($row[6]), 'Y.m.d'); ?></span>.
            </p>
            <p>In this regard we would like to request you to accept our invitaion and look forward to have a positive confirmation.
                Hope you oblige and do the needful.
            </p>
        </div>
        <div class="mt-3 text-center">
            <p>Thanking you,</p>
        </div>
        <div class="mt-3 text-right">
            <p>Yours Sincerely,</p>
        </div>
    </div>
</body>

</html>

<script>
    document.addEventListener('onload', printInfo());

    function printInfo() {
        window.print();
        window.onafterprint = function(event) {
            window.location.href = './my_bookings.php'
        };
    }
</script>