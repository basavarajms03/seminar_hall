<?php

include('./admin_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `departments` WHERE `id`=$_GET[id]") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Create Department</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Departments</p>
                <p class="page-subTitle text-danger font-weight-bold">Update Department</p>
            </div>
        </div>
        <form method="POST" action="" autocomplete="off">
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departmentId">Department Id</label>
                        <input type="text" class="form-control" name="departmentId" value="<?php echo $row[1]; ?>" id="departmentId" placeholder="Enter Department Id" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departmentName">Department Name</label>
                        <input type="text" class="form-control" name="departmentName" value="<?php echo $row[2]; ?>" id="departmentName" placeholder="Enter Department Name" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12 p-0 text-right">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $deptId = $_POST['departmentId'];
    $deptName = $_POST['departmentName'];
    $result = mysqli_query($con, "SELECT * FROM `departments` WHERE `deptId`=$deptId") or die(mysqli_error($con));
    $department_count = mysqli_num_rows($result);
    if ($department_count > 0 && $row[1] !== $deptId) {
?>
        <script>
            alert('Department is already exist!');
            document.location = './departments.php';
        </script>
        <?php
    } else {
        $insert_query = "UPDATE `departments` SET `deptId` = '$deptId', `department_name` = '$deptName' WHERE `departments`.`id` = $_GET[id]";
        if (mysqli_query($con, $insert_query)) {
        ?>
            <script>
                alert('Department has been updated successfully!');
                document.location = './departments.php';
            </script>
        <?php
        } else
        ?>
        <script>
            alert('Something went wrong!');
            document.location = './departments.php';
        </script>
<?php
}
}

?>