<?php

include('./admin_header.php');
include('../db/dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Create seminar hall</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Seminar Halls</p>
                <p class="page-subTitle text-danger font-weight-bold">Create Seminar Hall</p>
            </div>
        </div>
        <form action="" method="post" autocomplete="off">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="seminarHallName">Seminar Hall Name</label>
                    <input type="text" class="form-control" name="seminarHallName" id="seminarHallName" placeholder="Enter Seminar Hall Name" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="seminarHallDescription">Seminar Hall Description</label>
                    <textarea class="form-control" cols="6" rows="6" name="seminarHallDescription" id="seminarHallDescription" placeholder="Enter Seminar Hall Description" required></textarea>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $seminarHallName = ucfirst($_POST['seminarHallName']);
    $seminarHallDescription = $_POST['seminarHallDescription'];

    $result = mysqli_query($con, "SELECT * FROM `seminar_halls` WHERE `hall_name`='$seminarHallName'") or die(mysqli_error($con));
    $seminar_hall_count = mysqli_num_rows($result);
    if ($seminar_hall_count > 0) {
?>
        <script>
            alert('Seminar hall is already created!');
            document.location = './seminar_hall.php';
        </script>
        <?php
    } else {
        $insert_query = "INSERT INTO `seminar_halls` (`id`, `hall_name`, `hall_description`) VALUES (NULL, '$seminarHallName', '$seminarHallDescription')";
        if (mysqli_query($con, $insert_query)) {
        ?>
            <script>
                alert('Seminar hall has been created successfully!');
                document.location = './seminar_hall.php';
            </script>
        <?php
        } else {
        ?>
            <script>
                alert('Something went wrong!');
                // document.location = './seminar_hall.php';
            </script>
<?php
        }
    }
}
