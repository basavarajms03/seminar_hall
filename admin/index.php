<?php

include('./header.php');

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
                    <p class="text-center">Admin Login</p>
                </h3>
                <div class="form-group">
                    <label for="userID">Username</label>
                    <input type="text" class="form-control" name="username" id="userID" aria-describedby="emailHelp" placeholder="Enter Username">
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
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === 'admin' && $password === 'admin') {
?>
        <script>
            alert('Logged in successfully!');
            document.location = 'admin_home.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Please enter correct username and password!');
            document.location = './index.php';
        </script>
<?php
    }
}
