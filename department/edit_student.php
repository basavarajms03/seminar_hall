<?php

session_start();
include('./department_header.php');
include('../db/dbcon.php');

$result = mysqli_query($con, "SELECT * FROM `students_list` WHERE `id`='$_GET[id]'") or die(mysqli_error($con));
$student_row = mysqli_fetch_array($result);

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
            <div class="col-md-8">
                <p class="page-title font-weight-bold text-success m-0">Students List</p>
                <p class="page-subTitle text-danger font-weight-bold">Create Students</p>
            </div>
        </div>
        <form method="POST" action="" autocomplete="off">
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rollNo">Student Roll No</label>
                        <input type="text" value="<?php echo $student_row[1] ?>" class="form-control" name="rollNo" id="rollNo" placeholder="Roll No" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="studentName">Student Name</label>
                        <input type="text" value="<?php echo $student_row[2] ?>" class="form-control" name="studentName" id="studentName" placeholder="Name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="studentEmail">Student Email Id</label>
                        <input type="text" value="<?php echo $student_row[3] ?>" class="form-control" name="studentEmail" id="studentEmail" placeholder="Email Id" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sem">Select Semester</label>
                        <select class="form-control" id="sem" name="sem" required>
                            <option value="">--Semester--</option>
                            <option value="1" <?php echo $student_row[5] === '1' ? "selected": "" ?>>1st Sem</option>
                            <option value="2" <?php echo $student_row[5] === '2' ? "selected": "" ?>>2nd Sem</option>
                            <option value="3" <?php echo $student_row[5] === '3' ? "selected": "" ?>>3rd Sem</option>
                            <option value="4" <?php echo $student_row[5] === '4' ? "selected": "" ?>>4th Sem</option>
                            <option value="5" <?php echo $student_row[5] === '5' ? "selected": "" ?>>5th Sem</option>
                            <option value="6" <?php echo $student_row[5] === '6' ? "selected": "" ?>>6th Sem</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 text-right mb-5">
                    <button type="submit" name="submit" class="btn btn-success">Update Student</button>
                    <a href="./students_list.php" class="btn btn-outline-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {

    $result = mysqli_query($con, "SELECT * FROM `students_list` WHERE `roll_no`='$_POST[rollNo]' and `sem`=$_POST[sem]") or die(mysqli_error($con));
    $count = mysqli_num_rows($result);
    if ($count > 0) {
?>
        <script>
            alert('Student is already exist in the entered roll no!');
            document.location = './students_list.php';
        </script>
        <?php
    } else {
        $insert_query = "UPDATE `students_list` SET `roll_no` = '$_POST[rollNo]', `student_name` = '$_POST[studentName]', `student_email` = '$_POST[studentEmail]', `sem` = '$_POST[sem]' WHERE `students_list`.`id` = $_GET[id]";
        if (mysqli_query($con, $insert_query)) {
        ?>
            <script>
                alert('Student has been updated successfully!');
                document.location = './students_list.php';
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
