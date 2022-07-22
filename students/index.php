<?php

include('./header.php');
include('../db/dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="col-md-4">
            <form action="" method="post" autocomplete="off">
                <h3 class="font-weight-bold">
                    <p class="text-center">Student Login</p>
                </h3>
                <div class="form-group">
                    <label for="studentId">Student Register Number</label>
                    <input type="text" class="form-control" name="studentId" id="studentId" aria-describedby="emailHelp" placeholder="Enter Student Register Number">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            <p class="text-primary text-center font-weight-bold mt-3">
                Don't have an account? Click here to <a href="./student_register.php" class="link text-danger">Register</a>
            </p>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $username = $_POST['studentId'];
    $password = $_POST['password'];
    $check_query = "SELECT * FROM  `students_list` WHERE `roll_no` = '$username' AND `password` = '$password'";
    $check_result = mysqli_query($con, $check_query);
    $check_count = mysqli_num_rows($check_result);
    $check_rows = mysqli_fetch_array($check_result);
    if ($check_count > 0) {
        session_start();
        $_SESSION['userData'] = $check_rows;
?>
        <script>
            alert('Logged in successfully!');
            document.location = 'students_home.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Please enter correct username and password!');
            document.location = './';
        </script>
<?php
    }
}
