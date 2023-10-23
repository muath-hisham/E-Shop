<?php
include "../../PhpConfig/config.php";

if (isset($_POST['add_category'])) {
    $category = $_POST['add_category'];
    $sql = "INSERT INTO `categories` VALUES (NULL, '$category')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        unset($_POST['add_category']);
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
        <div class="card add_category">
            <div class="card-body">
                <form action="add_category.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Category</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="add_category" required>
                    </div>
                    <input type="submit" class="btn btn-primary w-100 mt-4" value="Add">
                </form>
            </div>
        </div>
    </div>
</body>

</html>