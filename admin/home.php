<?php
include "../PhpConfig/config.php";

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $sql = "SELECT * FROM `carts` WHERE cart_status = '$filter'";
    $carts_rows = mysqli_query($conn, $sql);
} else if (isset($_GET['date'])) {
    
} else {
    $carts_rows = mysqli_query($conn, "SELECT * FROM `carts`");
}

if (isset($_SESSION['admin'])) {
    $email = $_SESSION['admin']['email'];
    $password = $_SESSION['admin']['password'];
    $admin_row = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_email = '$email' AND admin_password = '$password'");
    $admin = mysqli_fetch_assoc($admin_row);
} else {
    header("Location: login.php");
}

if (isset($_GET['delete_category'])) {
    $deleteCat = $_GET['delete_category'];
    $sql = "DELETE FROM `categories` WHERE category_id = '$deleteCat'";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Something wrong!
             </div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_size'])) {
    // Retrieve the 'id' variable from the POST data
    $id = $_POST['delete_size'];

    // Provide a response (if needed)
    $sql = "DELETE FROM `size` WHERE size_id = '$id'";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        unset($_POST['delete_size']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Something wrong!
             </div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_color'])) {
    // Retrieve the 'id' variable from the POST data
    $id = $_POST['delete_color'];

    // Provide a response (if needed)
    $sql = "DELETE FROM `colors` WHERE color_id = '$id'";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        unset($_POST['delete_color']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
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
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">

    <!-- icon -->
    <!-- <link href="all.min.css" rel="stylesheet"> -->
    <!--css links-->
    <link rel="stylesheet" href="teacher.css">
    <link rel="stylesheet" href="controls.css">
    <link rel="stylesheet" href="home.css">
    <title>admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- when the user click on delete button in size -->
    <script>
        function confirmDeleteSize(id) {
            if (confirm("Are you sure you want to delete this size?")) {
                // User clicked "OK", perform the delete action here
                var xhr = new XMLHttpRequest();
                var url = "home.php"; // Replace with the actual URL of your PHP script
                var params = "delete_size=" + id; // Data to send

                xhr.open("POST", url, true);

                // Set up the request header (if needed)
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response from the PHP script (if needed)
                        var response = xhr.responseText;
                        console.log(response); // Log the response to the console
                    }
                };

                // Send the request
                xhr.send(params);
            }
        }

        function confirmDeleteColor(id) {
            if (confirm("Are you sure you want to delete this color?")) {
                // User clicked "OK", perform the delete action here
                var xhr = new XMLHttpRequest();
                var url = "home.php"; // Replace with the actual URL of your PHP script
                var params = "delete_color=" + id; // Data to send

                xhr.open("POST", url, true);

                // Set up the request header (if needed)
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response from the PHP script (if needed)
                        var response = xhr.responseText;
                        console.log(response); // Log the response to the console
                    }
                };

                // Send the request
                xhr.send(params);
            }
        }
    </script>
</head>

<body>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="#"><img src="../img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="home.php">Home</a></li>
                            <li><a href="products.php">Products</a></li>
                            <li><a href="login.php">logout</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->


    <!-- End Page Title -->
    <div class="container main" style="margin-top: 70px;">
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-4">

                    <!-- Website Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">

                            <div class="shop__sidebar">
                                <div class="shop__sidebar__accordion">
                                    <div class="accordion" id="accordionExample">
                                        <div class="mb-5" style="position: relative;">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseOne">All Categories</a>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="shop__sidebar__categories">
                                                        <ul class="nice-scroll">
                                                            <?php
                                                            $categories_rows = mysqli_query($conn, "SELECT * FROM `categories`");
                                                            foreach ($categories_rows as $category) {
                                                            ?>
                                                                <li><a><?= $category['category_name'] ?></a><a href="home.php?delete_category=<?= $category['category_id'] ?>" class="ml-4"><i class="fa-solid fa-trash"></i></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="update/add_category.php" class="btn btn-light w-100">Add Category</a>
                                        </div>
                                        <div class="mb-5" style="position: relative;">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseFour">All Sizes</a>
                                            </div>
                                            <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="shop__sidebar__size">
                                                        <?php
                                                        $size_rows = mysqli_query($conn, "SELECT * FROM `size`");
                                                        foreach ($size_rows as $size) {
                                                        ?>
                                                            <button class="btn p-0" onclick="confirmDeleteSize(<?= $size['size_id'] ?>)">
                                                                <label><?= $size['size_name'] ?>
                                                                </label>
                                                            </button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="update/add_size.php" class="btn btn-light w-100">Add Size</a>
                                        </div>
                                        <div class="mb-5" style="position: relative;">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseFive">All Colors</a>
                                            </div>
                                            <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="shop__sidebar__color">
                                                        <?php
                                                        $color_rows = mysqli_query($conn, "SELECT * FROM `colors`");
                                                        foreach ($color_rows as $color) {
                                                        ?>
                                                            <button class="btn p-0" onclick="confirmDeleteColor(<?= $color['color_id'] ?>)">
                                                                <label style="background-color: <?= $color['color_code'] ?>;">
                                                                </label>
                                                            </button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="update/add_color.php" class="btn btn-light w-100">Add Color</a>
                                        </div>
                                        <div class="mb-4" style="position: relative;">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseSix">Delivery</a>
                                            </div>
                                            <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="shop__sidebar__color">
                                                        <input type="text" class="form-control text-center" value="<?= $admin['delivery'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="update/change_delivery.php" class="btn btn-light w-100">Change Delivery</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div><!-- End Website Traffic -->



                </div><!-- End Left side columns -->



                <!-- Right side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xl-6 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Products</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-box"></i>
                                        </div>
                                        <div class="px-3">
                                            <!-- php code hereeeeeeeeeeeeeeeeeeeeeeeeee -->
                                            <?php
                                            $rows = mysqli_query($conn, "SELECT * FROM `products`");
                                            $num = mysqli_num_rows($rows);
                                            ?>
                                            <h6><?= $num ?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xl-6 col-md-6">
                            <div class="card info-card revenue-card">
                                <?php
                                $rows = mysqli_query($conn, "SELECT * FROM `carts`");
                                $num = mysqli_num_rows($rows);
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title">Orders</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </div>
                                        <div class="px-3">
                                            <h6><?= $num ?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- money Card -->
                        <div class="col-12">
                            <div class="card info-card customers-card">
                                <?php
                                $rows = mysqli_query($conn, "SELECT * FROM `carts`");
                                $num = 0;
                                foreach ($rows as $row) {
                                    $num += $row['cart_total_price'];
                                }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title">Total buyers</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-wallet"></i>
                                        </div>
                                        <div class="px-3">
                                            <h6><?= $num ?> LE</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Report about percentage of sales each day</h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>
                                    <?php
                                    $carts = mysqli_query($conn, "SELECT * FROM `carts`");

                                    $datetimeStrings = [];

                                    foreach ($carts as $order) {
                                        $datetimeStrings[] = $order['cart_date'];
                                    }

                                    // Initialize an empty associative array to store counts for each day
                                    $dayCounts = [];
                                    $allDays = [];

                                    // Loop through each datetime string and count orders by day
                                    foreach ($datetimeStrings as $datetimeString) {
                                        // Convert the datetime string to a DateTime object
                                        $dateTime = new DateTime($datetimeString);

                                        // Get the day in YYYY-MM-DD format
                                        $day = $dateTime->format('Y-m-d');

                                        // Increment the count for the corresponding day in the associative array
                                        if (isset($dayCounts[$day])) {
                                            $dayCounts[$day]++;
                                        } else {
                                            $dayCounts[$day] = 1;
                                            $day = $dateTime->format('m-d');
                                            $allDays[] = $day;
                                        }
                                    }
                                    ?>
                                    <canvas id="lineChart" width="400" height="200"></canvas>

                                    <script>
                                        var chartData = {
                                            labels: [
                                                <?php
                                                foreach ($allDays as $singelDay) {
                                                    echo "'" . $singelDay . "',";
                                                }
                                                ?>
                                            ],
                                            datasets: [{
                                                label: 'Sales',
                                                data: [
                                                    <?php
                                                    foreach ($dayCounts as $singelDay) {
                                                        echo $singelDay . ",";
                                                    }
                                                    ?>
                                                ],
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                fill: true,
                                            }, ],
                                        };

                                        var ctx = document.getElementById('lineChart').getContext('2d');
                                        var myLineChart = new Chart(ctx, {
                                            type: 'line',
                                            data: chartData,
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                    },
                                                },
                                            },
                                        });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->

                    </div>
                </div><!-- End Right side columns -->

                <!-- Top Selling -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mx-5 pb-3">
                                <h5 class="card-title pt-2">All Orders</h5>
                                <!-- Example single danger button -->
                                <div>
                                    <div class="btn-group mx-3" style="z-index: 1000;">
                                        <button type="button" class="btn btn-outline-ligth dropdown-toggle filter" data-toggle="dropdown" aria-expanded="false">
                                            <?php
                                            if (isset($_GET['filter'])) {
                                                echo $_GET['filter'];
                                            } else {
                                                echo 'All';
                                            }
                                            ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="home.php">All</a>
                                            <a class="dropdown-item" href="home.php?filter=under processing">Under Processing</a>
                                            <a class="dropdown-item" href="home.php?filter=delivering">Delivering</a>
                                            <a class="dropdown-item" href="home.php?filter=completed">Completed</a>
                                            <a class="dropdown-item" href="home.php?filter=canceled">Canceled</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped text-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $index = 1;
                                    foreach ($carts_rows as $cart) {
                                        $date = new DateTime($cart['cart_date']);
                                        $date = $date->format('m/d H:i');
                                    ?>
                                        <tr onclick="navigateToPage('cart_details.php?id=<?= $cart['cart_id'] ?>')" style="cursor: pointer;">
                                            <th scope="row"><?= $index ?></th>
                                            <td><?= $row['user_name'] ?></td>
                                            <td><?= $cart['user_phone'] ?></td>
                                            <td><?= $cart['user_address'] ?></td>
                                            <td><?= $cart['cart_total_price'] ?></td>
                                            <?php
                                            if ($cart['cart_status'] == "under processing") {
                                            ?>
                                                <td class="btn btn-secondary box w-75"><?= $cart['cart_status'] ?></td>
                                            <?php
                                            } else if ($cart['cart_status'] == "delivering") {
                                            ?>
                                                <td class="btn btn-warning box w-75"><?= $cart['cart_status'] ?></td>
                                            <?php
                                            } else if ($cart['cart_status'] == "completed") {
                                            ?>
                                                <td class="btn btn-success box w-75"><?= $cart['cart_status'] ?></td>
                                            <?php
                                            } else if ($cart['cart_status'] == "canceled") {
                                            ?>
                                                <td class="btn btn-danger box w-75"><?= $cart['cart_status'] ?></td>
                                            <?php
                                            }
                                            ?>
                                            <td><?= $date ?></td>
                                        </tr>
                                    <?php $index++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Top Selling -->

            </div>
        </section>
    </div>

    <!-- Js Plugins -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.nice-select.min.js"></script>
    <script src="../js/jquery.nicescroll.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/jquery.countdown.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/mixitup.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://kit.fontawesome.com/367b9c9fac.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script>
        // JavaScript function to navigate to another page
        function navigateToPage(url) {
            window.location.href = url;
        }
    </script>
</body>

</html>