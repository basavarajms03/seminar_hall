<?php

session_start();
include('./department_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `seminar_halls` WHERE `id`=$_GET[id]") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

$booking_hall_count = 1;
if (isset($_GET['check_available'])) {
    $from = $_GET['from'];
    $to = $_GET['to'];
    $result = mysqli_query($con, "SELECT * FROM `bookings` WHERE `seminar_hall_id` = '$_GET[id]' and `from_date` = '$from' and `to_date`='$to'") or die(mysqli_error($con));
    $booking_hall_count = mysqli_num_rows($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department - Book seminar hall</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Seminar Halls</p>
                <p class="page-subTitle text-danger font-weight-bold">Book Seminar Hall</p>
            </div>
            <div class="col-md-4 text-center">
                <p class="page-title font-weight-bold text-success m-0"><?php echo $row[1]; ?></p>
                <p title="<?php echo $row[2]; ?>" class="page-subTitle text-truncate text-danger font-weight-bold"><?php echo $row[2]; ?></p>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?php
            if (isset($_GET['check_available']) && $booking_hall_count > 0) {
            ?>
                <p class="alert alert-danger">Selected time slot has been booked! please select some other time</p>
            <?php
            }
            ?>
            <?php
            if ($booking_hall_count > 0) {
            ?>
                <h5 class="text-warning font-weight-bold">Check Availability</h5>
                <form action="" method="get">
                    <div class="row mt-3">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="from">From Date and Time</label>
                                <input type="datetime-local" class="form-control" name="from" id="from" <?php echo $booking_hall_count === 0 ? "disabled" : '' ?> required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="to">To Date and Time</label>
                                <input type="datetime-local" class="form-control" name="to" id="to" <?php echo $booking_hall_count === 0 ? "disabled" : '' ?> required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="check_available" class="btn btn-success mt-4" <?php echo $booking_hall_count === 0 ? "disabled" : '' ?>>Check Availability</button>
                        </div>
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
        <?php
        if (isset($_GET['check_available']) && $booking_hall_count === 0) {
        ?>
            <form action="" method="post" autocomplete="off">
                <h5 class="text-warning font-weight-bold">Fill Information</h5>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="organizer">Organizer Name</label>
                            <input type="text" class="form-control" name="organizer" id="organizer" placeholder="Enter Organizer Name" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="from">From Date and Time</label>
                            <input type="datetime-local" value="<?php echo  $_GET['from']; ?>" class="form-control" name="from" id="from" <?php echo $booking_hall_count === 0 ? "disabled" : '' ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to">To Date and Time</label>
                            <input type="datetime-local" value="<?php echo  $_GET['to']; ?>" class="form-control" name="to" id="to" <?php echo $booking_hall_count === 0 ? "disabled" : '' ?> required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guests">Guests Invited (Emails)</label>
                            <input type="text" class="form-control" name="guests" id="guests" placeholder="Enter Guests Invited" required>
                            <small class="text-muted font-weight-bold">Enter emails with comma separated</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" cols="6" rows="6" class="form-control" name="description" id="description" placeholder="Enter Description" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right mb-5">
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <a href="./seminar_hall.php" class="btn btn-outline-danger">Cancel</a>
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $seminar_hall_id = $_GET['id'];
    $deptId = $_SESSION['deptId'];
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $organizerName = $_POST['organizer'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $guests = $_POST['guests'];
    $description = $_POST['description'];

    $result = mysqli_query($con, "SELECT * FROM `bookings` WHERE `seminar_hall_id` = '$seminar_hall_id' and `from_date` = '$from' and `to_date`='$to'") or die(mysqli_error($con));
    $booking_hall_count = mysqli_num_rows($result);
    if ($booking_hall_count > 0) {
?>
        <script>
            alert("Selected time slot has been booked! please select some other time");
            document.location = './seminar_hall.php';
        </script>
        <?php
    } else {
        $insert_query = "INSERT INTO `bookings` (`id`, `deptId`, `seminar_hall_id`, `title`, `subTitle`, `organizerName`, `from_date`, `to_date`, `guests`, `description`, `status`) VALUES (NULL, '$deptId', '$seminar_hall_id', '$title', '$subject', '$organizerName', '$from', '$to', '$guests', '$description', 'Approved')";
        if (mysqli_query($con, $insert_query)) {
        ?>
            <script>
                alert("Slot has been booked!");
                document.location = './seminar_hall.php';
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Something went wrong!");
                document.location = './seminar_hall.php';
            </script>
<?php
            die(mysqli_error($con));
        }
    }
}

?>