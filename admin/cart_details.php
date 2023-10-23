<?php
include "../PhpConfig/config.php";

$delivery = 30;

$Cid = 0;
if (isset($_GET['id'])) {
    $Cid = $_GET['id'];
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == "under_processing") {
        $sql = "UPDATE `carts` SET cart_status = 'under processing' WHERE cart_id = '$Cid'";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Something wrong!";
        }
    } else if ($status == "delivering") {
        $sql = "UPDATE `carts` SET cart_status = 'delivering' WHERE cart_id = '$Cid'";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Something wrong!";
        }
    } else if ($status == "completed") {
        $sql = "UPDATE `carts` SET cart_status = 'completed' WHERE cart_id = '$Cid'";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Something wrong!";
        }
    } else if ($status == "canceled") {
        $sql = "UPDATE `carts` SET cart_status = 'canceled' WHERE cart_id = '$Cid'";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Something wrong!";
        }
    }
}

$productsBuyed = mysqli_query($conn, "SELECT * FROM `cart_items` NATURAL JOIN `products` WHERE cart_id = '$Cid'");

$cart_row = mysqli_query($conn, "SELECT * FROM `carts` WHERE cart_id = '$Cid'");
$cart = mysqli_fetch_assoc($cart_row);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>abdo</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">

    <!--css links-->
    <link rel="stylesheet" href="teacher.css">
    <link rel="stylesheet" href="controls.css">
    <link rel="stylesheet" href="home.css">
</head>

<body style="background-color: #F9F9F9 !important;">
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="../index.php"><img src="../img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="./shop.php">Shop</a></li>
                            <li><a href="./about.php">About Us</a></li>
                            <li><a href="./contact.php">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad pt-5">
        <div class="container">
            <div class="card">
                <div class="card-body pb-0">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $cart['user_name'] ?></td>
                                <td><?= $cart['user_phone'] ?></td>
                                <td><?= $cart['user_address'] ?></td>
                                <td><?= $cart['cart_status'] ?></td>
                                <td><?= $cart['cart_date'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">

                    <div class="card">

                        <div class="card-body pb-0">
                            <div class="shopping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($productsBuyed as $productBuyed) {
                                            $imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = '{$productBuyed['product_id']}'");
                                            $firstImg = mysqli_fetch_assoc($imgs);
                                        ?>
                                            <tr>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="../img/product/<?= $firstImg['product_img_path'] ?>" style="width: 100px; height: 100px;">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6><?= $productBuyed['product_name'] ?></h6>
                                                        <h5><?= $productBuyed['price'] ?> LE</h5>
                                                        <div class="product__details__option__color inline">
                                                            <label style="background-color: #<?= $productBuyed['color'] ?>;"></label>
                                                        </div>
                                                        <strong><?= $productBuyed['size'] ?></strong>
                                                    </div>
                                                </td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="text" value="<?= $productBuyed['quantity'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price"><?= $productBuyed['quantity'] * $productBuyed['price'] ?> LE</td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="card">

                        <div class="card-body">
                            <div class="cart__total">
                                <h6>Cart total</h6>
                                <?php
                                $subTotal = 0;
                                foreach ($productsBuyed as $key => $productBuyed) {
                                    $itemPrice = $productBuyed['quantity'] * $productBuyed['price'];
                                    $subTotal += $itemPrice;
                                }
                                if ($subTotal != 0) {
                                ?>
                                    <ul class="checkout__total__all">
                                        <li>Subtotal <span><?= $subTotal ?> LE</span></li>
                                        <li>Delivery <span><?= $delivery ?> LE</span></li>
                                    </ul>
                                    <ul class="checkout__total__all m-0 pb-0">
                                        <li>Total <span><?= $subTotal + $delivery ?> LE</span></li>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="card">

                        <div class="card-body">
                            <h6 class="mb-3 text-center" style="font-size: 18px; font-weight: bold;">Change Status</h6>
                            <a href="cart_details.php?id=<?= $Cid ?>&status=under_processing" class="w-100 mb-2 btn btn-secondary box">under processing</a>
                            <a href="cart_details.php?id=<?= $Cid ?>&status=delivering" class="w-100 mb-2 btn btn-warning box">delivering</a>
                            <a href="cart_details.php?id=<?= $Cid ?>&status=completed" class="w-100 mb-2 btn btn-success box">completed</a>
                            <a href="cart_details.php?id=<?= $Cid ?>&status=canceled" class="w-100 mb-2 btn btn-danger box">canceled</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

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
</body>

</html>