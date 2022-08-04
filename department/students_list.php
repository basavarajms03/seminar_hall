<?php

session_start();
include('./department_header.php');
include('../db/dbcon.php');

if (isset($_GET['sem'])) {
    $result = mysqli_query($con, "SELECT * FROM `students_list` WHERE deptId = $_SESSION[deptId]  and `sem`='$_GET[sem]'") or die(mysqli_error($con));
    $seminar_hall_count = mysqli_num_rows($result);
} else {
    $result = mysqli_query($con, "SELECT * FROM `students_list` WHERE deptId = $_SESSION[deptId]") or die(mysqli_error($con));
    $seminar_hall_count = mysqli_num_rows($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department - Students List</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-4">
                <p class="page-title font-weight-bold text-success m-0">Students List</p>
                <p class="page-subTitle text-danger font-weight-bold">Students list information</p>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" id="sem" name="sem" onchange="onSelectSemester(event)" required>
                        <option value="">--Semester--</option>
                        <option value="1" <?php echo isset($_GET['sem']) && $_GET['sem'] === '1' ? 'selected' : ''; ?>>1st Sem</option>
                        <option value="2" <?php echo isset($_GET['sem']) && $_GET['sem'] === '2' ? 'selected' : ''; ?>>2nd Sem</option>
                        <option value="3" <?php echo isset($_GET['sem']) && $_GET['sem'] === '3' ? 'selected' : ''; ?>>3rd Sem</option>
                        <option value="4" <?php echo isset($_GET['sem']) && $_GET['sem'] === '4' ? 'selected' : ''; ?>>4th Sem</option>
                        <option value="5" <?php echo isset($_GET['sem']) && $_GET['sem'] === '5' ? 'selected' : ''; ?>>5th Sem</option>
                        <option value="6" <?php echo isset($_GET['sem']) && $_GET['sem'] === '6' ? 'selected' : ''; ?>>6th Sem</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <a href="./create_students.php" class="btn btn-success font-weight-bold">Create Student</a>
            </div>
        </div>
        <div class="mt-4">
            <?php
            if ($seminar_hall_count === 0) {
            ?>
                <div class="text-center">
                    <img src="./../images/no-data.png" alt="No Data" width="300px">
                    <p class="text-muted font-weight-bold m-0">No students found</p>
                    <small class="text-danger font-weight-bold">Create students to display over here.</small>
                </div>
            <?php
            } else {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-danger text-light">
                            <th scope="col">#</th>
                            <th scope="col">Roll No</th>
                            <th scope="col">Student Id</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Semester</th>
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
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td><a href="./edit_student.php?id=<?php echo $row[0]; ?>" class="badge badge-success">Edit</a></td>
                                <td><a href="./students_list.php?id=<?php echo $row[0]; ?>" class="badge badge-danger">Delete</a></td>
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
    $delete_query = "DELETE FROM `students_list` WHERE `students_list`.`id` = $_GET[id]";
    if (mysqli_query($con, $delete_query)) {
?>
        <script>
            alert('Student has been deleted successfully!');
            document.location = './students_list.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something went wrong!');
            document.location = './students_list.php';
        </script>
<?php
    }
}

?>

<script>
    function onSelectSemester(event) {
        if (event.target.value) {
            document.location = "./students_list.php?sem=" + event.target.value;
        } else {
            document.location = "./students_list.php";
        }
    }
</script>