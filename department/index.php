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
    <title>Admin Login</title>
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
                    <p class="text-center">Department Login</p>
                </h3>
                <div class="form-group">
                    <label for="deptId">Department Id</label>
                    <input type="text" class="form-control" name="deptId" id="deptId" aria-describedby="emailHelp" placeholder="Enter Department Id">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $username = $_POST['deptId'];
    $password = $_POST['password'];
    $check_query = "SELECT * FROM  `users` WHERE `deptId` = $username AND `password` = $password";
    $check_result = mysqli_query($con, $check_query);
    $check_count = mysqli_num_rows($check_result);
    $check_rows = mysqli_fetch_array($check_result);
    if ($check_count > 0) {
        session_start();
        $_SESSION['deptId'] = $username;
?>
        <script>
            alert('Logged in successfully!');
            document.location = 'department_home.php';
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
