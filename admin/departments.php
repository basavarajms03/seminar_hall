<?php

include('./admin_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, 'SELECT * FROM `departments`') or die(mysqli_error($con));
$department_count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Departments</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Departments</p>
                <p class="page-subTitle text-danger font-weight-bold">Departments List</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="./create_department.php" class="btn btn-success font-weight-bold">Create Department</a>
            </div>
        </div>
        <div class="mt-4">
            <?php
            if ($department_count === 0) {
            ?>
                <div class="text-center">
                    <img src="./../images/no-data.png" alt="No Data" width="300px">
                    <p class="text-muted font-weight-bold m-0">No departments found</p>
                    <small class="text-danger font-weight-bold">Create departments to display over here.</small>
                </div>
            <?php
            } else {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-danger text-light">
                            <th scope="col">#</th>
                            <th scope="col">Department Id</th>
                            <th scope="col">Department Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $count = $count + 1;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><a href="./update_department.php?id=<?php echo $row[0]; ?>" class="badge badge-success">Edit</a></td>
                                <td><a href="./departments.php?id=<?php echo $row[0]; ?>" class="badge badge-danger">Delete</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_GET['id'])) {
    $delete_query = "DELETE FROM `departments` WHERE `departments`.`id` = $_GET[id]";
    if (mysqli_query($con, $delete_query)) {
?>
        <script>
            alert('Department has been deleted successfully!');
            document.location = './departments.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something went wrong!');
            document.location = './departments.php';
        </script>
<?php
    }
}
