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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
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
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $numberOfItmes = count($_SESSION['cart']);
                            $totalPrice = 0;
                            foreach ($_SESSION['cart'] as $key => $productBuyed) {
                                $restoredProductBuyed = unserialize($productBuyed);

                                // Calculate the subtotal for each item (price * quantity)
                                $subtotal = $restoredProductBuyed->getProduct()->getPriceAfter() * $restoredProductBuyed->getQuantity();

                                // Add the subtotal to the total price
                                $totalPrice += $subtotal;
                            }
                        } else {
                            $numberOfItmes = 0;
                            $totalPrice = 0;
                        }
                        ?>
                        <a href="cart.php">
                            <img src="img/icon/cart.png" alt="">
                            <span><?= $numberOfItmes ?></span>
                            <span class="price ml-1"><?= $totalPrice ?> LE</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="thanks.php" method="POST">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">

                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="checkout__input">
                                <p>Name<span>*</span></p>
                                <input type="text" name="name" required>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add" required>
                            </div>
                            <div class="checkout__input">
                                <p>Phone Number<span>*</span></p>
                                <input type="text" name="phone" required>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    <?php
                                    if (isset($_SESSION['cart'])) {
                                        $subTotal = 0;
                                        foreach ($productsBuyed as $key => $productBuyed) {
                                            $itemPrice = $productBuyed->getQuantity() * $productBuyed->getProduct()->getPriceAfter();
                                            $subTotal += $itemPrice;
                                    ?>
                                            <li><?= $key +1 ?>. <?= $productBuyed->getProduct()->getName() ?>x<?= $productBuyed->getQuantity() ?> <span><?= $itemPrice ?> LE</span></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span><?= $subTotal ?> LE</span></li>
                                    <li>Delivery <span><?= $delivery ?> LE</span></li>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Total <span><?= $subTotal + $delivery ?> LE</span></li>
                                </ul>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>

                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="footer__widget">
                        <h6>Pages</h6>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Shop</a></li>
                            <li><a href="#">About Us</li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="social-links text-center pt-3 pt-md-0 ">
                        <a href="#" target="_blank" class="d-block" title="telegram"><i class="fa fa-telegram"></i></a>
                        <a href="#" target="_blank" title="facebook" class="d-block"><i class="fa fa-facebook-square"></i></a>
                        <a href="#" target="_blank" title="instagram" class="d-block"><i class="fa fa-instagram"></i></a>
                        <a href="#" target="_blank" title="twitter" class="d-block"><i class="fa fa-twitter-square"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright © 2023 All rights reserved</p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>