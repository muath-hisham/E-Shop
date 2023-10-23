<?php
include "PhpConfig/config.php";
include "PhpConfig/OOP.php";

$productsBuyed = array();
$delivery = 30;

if (isset($_SESSION['cart'])) {
    $items = $_SESSION['cart'];
    foreach ($items as $key => $productBuyed) {
        $restoredProductBuyed = unserialize($productBuyed);
        $productsBuyed[$key] = $restoredProductBuyed;
    }
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $totalPrice = 0;
    foreach ($productsBuyed as $key => $productBuyed) {
        $itemPrice = $productBuyed->getQuantity() * $productBuyed->getProduct()->getPriceAfter();
        $totalPrice += $itemPrice;
    }

    $date = new DateTime();

    // Prepare the SQL INSERT statement
    $sql = "INSERT INTO `carts` VALUES (NULL, '$name', '$phone', '$address', '$totalPrice', '$delivery', 'under processing', '{$date->format('Y-m-d H:i:s')}')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        $carts = mysqli_query($conn, "SELECT * FROM `carts` WHERE cart_date = '{$date->format('Y-m-d H:i:s')}' AND user_name = '$name'");
        $cart_row = mysqli_fetch_assoc($carts);
        $cartId = $cart_row['cart_id'];
        foreach ($productsBuyed as $hey => $productBuyed) {
            $Pid = $productBuyed->getProduct()->getId();
            $price = $productBuyed->getProduct()->getPriceAfter();
            $quantity = $productBuyed->getQuantity();
            $sql2 = "INSERT INTO `cart_items` VALUES (NULL, '$cartId', '$Pid', '$price', '$quantity')";
            if ($conn->query($sql2) === TRUE) {
            } else {
                echo "Something wrong!";
            }
        }
    } else {
        echo "Something wrong!";
    }
    session_destroy();
}
?>


<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>thanks</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
    <style>
        @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
        @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
    <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
    <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
</head>

<body>
    <header class="site-header" id="header">
        <h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
    </header>

    <div class="main-content">
        <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
        <p class="main-content__body" data-lead-id="main-content-body">I want to extend a heartfelt thank you to you personally for your trust and for choosing to shop with us. Your loyalty means the world to us!</p>
    </div>

    <div class="main-content">
        <a href="index.php" class="btn btn-success mt-4 mb-5" style="color: white !important;">Home</a>
    </div>

    <footer class="mt-5" id="footer">
        <p class="site-footer__fineprint" id="fineprint">Copyright ©2023 | All Rights Reserved</p>
    </footer>
</body>

</html>