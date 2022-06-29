<?php

$con = mysqli_connect('localhost', 'root', '', 'seminar_hall') or die(mysqli_error($con));

mysqli_select_db($con, 'seminar_hall') or die(mysqli_error($con));

?>