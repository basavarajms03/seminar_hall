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
        <div class="row mt-3">
            <div class="col-md-4">
                <p class="page-title font-weight-bold text-success m-0">My Bookings</p>
                <p class="page-subTitle text-danger font-weight-bold">My Bookings Details</p>
            </div>
            <div class="col-md-4 text-center">
                <p class="page-title font-weight-bold text-success m-0">Title: <?php echo $row[3]; ?></p>
                <p title="<?php echo $row[4]; ?>" class="page-subTitle text-truncate text-danger font-weight-bold">Sub Title: <?php echo $row[4]; ?></p>
            </div>
            <div class="col-md-4 text-right">
                <a href="./invite_letter.php?id=<?php echo $_GET['id']; ?>" class="btn btn-outline-danger">Invite</a>
                <a href="./appreciation_letter.php?id=<?php echo $_GET['id']; ?>" class="btn btn-outline-success">Appreciation</a>
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
                    <div class="col-md-12">
                        <p class="text-title mb-1 font-weight-bold text-secondary">Status</p>
                        <p class="text-warning m-0 font-weight-bold"><?php echo $row[10]; ?></p>
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
                        <p class="text-title mb-1 font-weight-bold text-secondary">Accessories</p>
                        <p class="text-muted m-0"><?php echo $row[13]; ?></p>
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
                    <div class="card border-success mb-3">
                        <div class="card-header text-success text-center font-weight-bold">Upload Files</div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="images[]" accept="image/png, image/gif, image/jpeg, application/pdf" class="custom-file-input" id="inputGroupFile01" multiple>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="upload" class="btn btn-outline-success">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($row[10] !== "cancelled") {
                ?>
                    <div class="card border-danger">
                        <div class="card-header text-danger font-weight-bold text-center">Cancel Hall</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <input type="text" class="form-control" name="reason" id="reason" placeholder="Reason for cancellation" required>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" name="cancel" class="btn btn-outline-danger">Cancel</button>
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
if (isset($_POST['upload'])) {

    $imagesInfo = array();

    // Count total files
    $countfiles = count($_FILES['images']['name']);

    // Looping all files
    for ($i = 0; $i < $countfiles; $i++) {
        $filename = $_FILES['images']['name'][$i];

        array_push($imagesInfo, 'uploads/' . $filename);

        // Upload file
        move_uploaded_file($_FILES['images']['tmp_name'][$i], '../uploads/' . $filename);
    }

    $images = implode(',', $imagesInfo);

    $query = "UPDATE `bookings` SET `images` = '$images' WHERE `bookings`.`id` = $_GET[id]";

    if (mysqli_query($con, $query)) {
?>
        <script>
            alert("Files has been uploaded!");
            document.location = "./view_seminar_hall.php?id=<?php echo $_GET['id'] ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something went wrong!");
            document.location = "./view_seminar_hall.php?id=<?php echo $_GET['id'] ?>";
        </script>
<?php
    }
}
?>

<?php

if (isset($_POST['cancel'])) {
    $query = "UPDATE `bookings` SET `status` = 'cancelled', `cancellation_reason` = '$_POST[reason]' WHERE `bookings`.`id` = $_GET[id]";
    if (mysqli_query($con, $query)) {
?>
        <script>
            alert("Booking has been cancelled successfully!");
            document.location = "./view_seminar_hall.php?id=<?php echo $_GET['id'] ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something went wrong!");
            document.location = "./view_seminar_hall.php?id=<?php echo $_GET['id'] ?>";
        </script>
<?php
    }
}

?>