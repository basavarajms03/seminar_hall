<?php

session_start();
include('./department_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `departments` WHERE `deptId`=$_SESSION[deptId]") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department - Profile</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Profile</p>
                <p class="page-subTitle text-danger font-weight-bold">Department Profile</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="" autocomplete="off">
                    <div class="card border-success">
                        <p class="card-header text-success font-weight-bold">Update Information</p>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departmentId">Department Id</label>
                                        <input type="text" readonly class="form-control" name="departmentId" value="<?php echo $row[1]; ?>" id="departmentId" placeholder="Enter Department Id" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departmentName">Department Name</label>
                                        <input type="text" class="form-control" name="deptName" value="<?php echo $row[2]; ?>" id="departmentName" placeholder="Enter Department Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-0 text-right">
                                <button type="submit" name="submit" class="btn btn-outline-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card border-danger">
                    <p class="text-danger card-header font-weight-bold">Update Passsword</p>
                    <div class="card-body">
                        <form method="POST" action="" autocomplete="off">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departmentName">Confirm Password</label>
                                        <input type="password" class="form-control" name="confPassword" id="confPassword" placeholder="Enter Confirm Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-0 text-right">
                                <button type="submit" name="update" class="btn btn-outline-danger">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $insert_query = "UPDATE `departments` SET `department_name` = '$_POST[deptName]' WHERE `departments`.`deptId` = $_SESSION[deptId]";
    if (mysqli_query($con, $insert_query)) {
?>
        <script>
            alert('Department has been updated successfully!');
            document.location = './profile.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something went wrong!');
            document.location = './profile.php';
        </script>
<?php
    }
}

?>

<?php

if (isset($_POST['update'])) {
    $insert_query = "UPDATE `users` SET `password` = '$_POST[password]' WHERE `users`.`deptId` = $_SESSION[deptId]";
    if (mysqli_query($con, $insert_query)) {
?>
        <script>
            alert('Password has been updated successfully!');
            document.location = './profile.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something went wrong!');
            document.location = './profile.php';
        </script>
<?php
    }
}

?>