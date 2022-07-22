<?php

session_start();
include('./students_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `bookings` b, `seminar_halls` s
WHERE b.seminar_hall_id = s.id AND b.id = $_GET[id]") or die(mysqli_error($con));
$seminar_hall_count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$images = explode(',', $row[11]);

$rollNo = $_SESSION['userData'][1];
$feedback_query = "SELECT * FROM `feedback` f, `bookings` b, `students_list` s 
WHERE f.booking_id = b.id and f.student_id = s.roll_no and f.booking_id = $_GET[id] and f.student_id='$rollNo'";
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
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">My Bookings</p>
                <p class="page-subTitle text-danger font-weight-bold">My Bookings Details</p>
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
                    <div class="col-md-12">
                        <p class="text-title mb-1 font-weight-bold text-secondary">Status</p>
                        <p class="text-warning m-0 font-weight-bold"><?php echo $row[10]; ?></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <p class="text-title mb-1 font-weight-bold text-secondary">From</p>
                        <p class="text-muted m-0"><?php echo $row[6]; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-title mb-1 font-weight-bold text-secondary">To</p>
                        <p class="text-muted m-0"><?php echo $row[7]; ?></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="text-title mb-1 font-weight-bold text-danger">Seminar Hall Name</p>
                        <p class="m-0 text-success"><?php echo $row[14]; ?></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="text-title mb-1 font-weight-bold text-secondary">Guests</p>
                        <p class="text-muted m-0"><?php echo $row[8]; ?></p>
                    </div>
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
                                ?>
                                    <img class="uploaded-images" src="./../<?php echo $images[$i]; ?>" alt="" />
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-md-6">
                <?php
                if ($row[10] !== "cancelled") {
                ?>
                    <div class="card border-success">
                        <div class="card-header text-success font-weight-bold text-center">Student Feedback</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="Feedback">Feedback</label>
                                    <textarea name="feedback" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="submit_feedback" class="btn btn-primary ml-3 mb-2">Submit Feedback</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="card border-danger mt-3">
                    <div class="card-header text-danger font-weight-bold text-center">Feedback</div>
                    <div class="card-body">
                        <?php
                        if ($feedback_count === 0) {
                        ?>
                            <p class="text-danger">No Feedback has been added.</p>
                            <?php
                        } else {
                            while ($row = mysqli_fetch_array($feedback_result)) {
                            ?>
                                <div class="row mt-3">
                                    <div class="col-md-1">
                                        <img class="avatar" src="./../images/avatar.png" alt="Avatar" />
                                    </div>
                                    <div class="col-md-11">
                                        <p class="m-0">
                                            <small class="font-weight-bold text-success"><?php echo $row[19]; ?></small>
                                        </p>
                                        <p class="m-0">
                                            <small class="text-muted font-weight-bold"><?php echo $row[3]; ?></small>
                                        </p>
                                        <p><?php echo $row[1]; ?></p>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit_feedback'])) {
    $query = "INSERT INTO `feedback` (`booking_id`, `feedback`, `student_id`) 
    VALUES ($_GET[id], '$_POST[feedback]', $rollNo)";
    if (mysqli_query($con, $query)) {
?>
        <script>
            alert("Feedback has been submitted successfully!");
            document.location = "./feedback.php?id=4";
        </script>
<?php
    } else {
        die(mysqli_error($con));
    }
}
