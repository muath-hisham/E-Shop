<?php
include "../../PhpConfig/config.php";

if (isset($_POST['color_name'])) {
    $name = $_POST['color_name'];
    $code = $_POST['color_code'];
    $sql = "INSERT INTO `colors` VALUES (NULL, '$name', '$code')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        unset($_POST['add_color']);
        header("Location: ../home.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Something wrong!
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
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">

    <!-- icon -->
    <!-- <link href="all.min.css" rel="stylesheet"> -->
    <!--css links-->
    <link rel="stylesheet" href="../teacher.css">
    <link rel="stylesheet" href="../controls.css">
    <link rel="stylesheet" href="../home.css">
    <title>admin</title>

</head>

<body>
    <!-- End Page Title -->
    <div class="container">
        <div class="card add_color">
            <div class="card-body">
                <form action="add_color.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Color name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="color_name" required>
                        <label for="colorPicker" class="mt-3">The color</label>
                        <input type="color" class="form-control" id="colorPicker" name="color_code" required>
                    </div>
                    <input type="submit" class="btn btn-primary w-100 mt-4" value="Add">
                </form>
            </div>
        </div>
    </div>
</body>

</html>