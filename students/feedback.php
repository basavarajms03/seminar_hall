<?php

include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `bookings` b, `departments` d, `seminar_halls` s
          WHERE b.deptId = d.deptId and b.seminar_hall_id = s.id and b.id=$_GET[id]") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

if (isset($_GET['studentRollNo'])) {
    $student_query = "SELECT * FROM `students_list` WHERE `roll_no` = $_GET[studentRollNo]";
    $result = mysqli_query($con, $student_query);
    $count = mysqli_num_rows($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/bootstrap.js"></script>
    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold" href="#">Seminar Hall</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php#about">About</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php#seminars">Seminars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/index.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../department/index.php">Department Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container-fluid mt-3 mb-3">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0"><?php echo $row[3]; ?></p>
                <p class="page-subTitle text-danger font-weight-bold"><?php echo $row[4]; ?></p>
            </div>
        </div>
        <?php
        if (isset($_GET['studentRollNo']) && $count === 0) {
        ?>
            <p class="alert alert-danger font-weight-bold">Student is not available, Please register first.</p>
        <?php
        }
        ?>
        <form method="get" class="form-inline" autocomplete="off">
            <div class="form-group mb-2">
                <label for="studentRollNo" class="sr-only">Student Roll No</label>
                <input type="text" required class="form-control" id="studentRollNo" name="studentRollNo" placeholder="Student Roll No">
            </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="btn btn-primary ml-3 mb-2">Confirm identity</button>
        </form>
        <?php
        if (isset($_GET['studentRollNo']) && $count !== 0) {
        ?>
            <form action="" method="post">
                <h5 class="mt-3 text-danger font-weight-bold">Feedback Form</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Feedback">Feedback</label>
                            <textarea name="feedback" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right">
                        <button type="submit" name="submit_feedback" class="btn btn-primary ml-3 mb-2">Submit Feedback</button>
                    </div>
                </div>
            </form>
        <?php
        }
        ?>
    </main>
    <footer class="bg-dark text-light p-2 font-weight-bold mt-auto">
        <p class="m-0 text-center">&copy; All Copyrights reserved.</p>
    </footer>
</body>

</html>

<?php

if (isset($_POST['submit_feedback'])) {
    $query = "INSERT INTO `feedback` (`booking_id`, `feedback`, `student_id`) VALUES ($_GET[id], '$_POST[feedback]', $_GET[studentRollNo])";
    if (mysqli_query($con, $query)) {
?>
        <script>
            alert("Feedback has been submitted successfully!");
            document.location = "../index.php#seminars";
        </script>
<?php
    } else {
        die(mysqli_error($con));
    }
}
