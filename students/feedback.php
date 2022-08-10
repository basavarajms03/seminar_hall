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
    <title>Student - Booking Deatils</title>
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
                        <p class="m-0 text-success font-weight-bold"><?php echo $row[17]; ?></p>
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
                                        <img class="uploaded-images" src="./../<?php echo $images[$i]; ?>" alt="" />
                                    <?php
                                    } else { ?>
                                        <div>
                                            <object data="./../<?php echo $images[$i]; ?>" type="application/pdf" width="100%" height="200">
                                            </object>
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
            <div class="col-md-6">
                <?php
                if ($row[10] !== "cancelled") {
                ?>
                    <div class="card border-success">
                        <div class="card-header text-success font-weight-bold text-center">Student Feedback</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="question1">
                                    <p>1. How helpful was the event?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question1" id="extreme" value="Extremely Helpful">
                                        <label class="form-check-label" for="extreme">
                                            Extremely Helpful
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question1" id="very" value="Very Helpful">
                                        <label class="form-check-label" for="very">
                                            Very Helpful
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question1" id="notatall" value="Not at all Helpful">
                                        <label class="form-check-label" for="notatall">
                                            Not at all Helpful
                                        </label>
                                    </div>
                                </div>
                                <div class="question1 mt-3">
                                    <p>2. Did the event help you with new learnings or knowledge?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question2" id="yes" value="Yes">
                                        <label class="form-check-label" for="yes">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question2" id="no" value="No">
                                        <label class="form-check-label" for="no">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="question1 mt-3">
                                    <p>3. The workshop content was relevent and easy to understand?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question3" id="yes1" value="Yes">
                                        <label class="form-check-label" for="yes1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question3" id="no1" value="No">
                                        <label class="form-check-label" for="no1">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="question1 mt-3">
                                    <p>4. The facilatators were well prepared and responsive to participants questions?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question4" id="yes2" value="Yes">
                                        <label class="form-check-label" for="yes2">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question4" id="no2" value="No">
                                        <label class="form-check-label" for="no2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="question1 mt-3">
                                    <p>5. The material was presented in an organized manner?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question5" id="yes3" value="Yes">
                                        <label class="form-check-label" for="yes3">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question5" id="no2" value="No">
                                        <label class="form-check-label" for="no2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="Feedback">Please share any additional comments</label>
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
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit_feedback'])) {
    $query = "INSERT INTO `feedback` (`booking_id`, `feedback`, `student_id`, `1st`, `2nd`, `3rd`, `4th`, `5th`) 
    VALUES ($_GET[id], '$_POST[feedback]', '$rollNo', '$_POST[question1]', '$_POST[question2]', '$_POST[question3]', '$_POST[question4]', '$_POST[question5]')";
    if (mysqli_query($con, $query)) {
?>
        <script>
            alert("Feedback has been submitted successfully!");
            document.location = "./feedback.php?id=<?php echo $_GET['id']; ?>";
        </script>
<?php
    } else {
        die(mysqli_error($con));
    }
}
