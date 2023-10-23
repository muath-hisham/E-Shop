<?php
include "../PhpConfig/config.php";
session_destroy();
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin_row = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_email = '$email' AND admin_password = '$password'");
    if (mysqli_num_rows($admin_row) > 0) {
        $admin = mysqli_fetch_assoc($admin_row);
        $_SESSION['admin']['email'] = $email;
        $_SESSION['admin']['password'] = $password;
        header("Location: home.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
                  Email or Password is wrong!
             </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- bootstrab css -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">

    <!-- icon -->
    <!-- <link href="all.min.css" rel="stylesheet"> -->
    <!--css links-->
    <link rel="stylesheet" href="teacher.css">
    <link rel="stylesheet" href="controls.css">
    <link rel="stylesheet" href="home.css">
    <title>admin</title>

</head>

<body>
    <!-- End Page Title -->
    <div class="container">
        <div class="card login">
            <div class="card-body">
                <div class="header__logo">
                    <a href="login.php"><img src="../img/logo.png" alt=""></a>
                </div>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                    <input type="submit" class="btn btn-primary w-100 mt-4" value="Login">
                </form>
            </div>
        </div>
    </div>
</body>

</html>