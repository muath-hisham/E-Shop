<?php
include "PhpConfig/config.php";
include "PhpConfig/OOP.php";
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
                            <li class="active"><a href="./index.php">Home</a></li>
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

    <!-- Hero Section Begin -->
    <section class="hero pb-5">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Fall - Winter Collections 2030</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                <a href="shop.php" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Fall - Winter Collections 2030</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 shop__sidebar__categories">
                    <ul class="filter__controls">
                        <li data-filter=".hot-sales">Best Sales</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                <!-- get all data to new arrivals from database -->
                <?php
                $new_arrivals_rows = mysqli_query($conn, "SELECT * FROM `new_arrivals` NATURAL JOIN `products`");
                foreach ($new_arrivals_rows as $new_arrivals) {
                    $product_id = $new_arrivals['product_id'];
                    $new_arrivals_all_imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = $product_id");
                    $new_arrivals_img = mysqli_fetch_assoc($new_arrivals_all_imgs);
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <a href="product-details.php?id=<?= $new_arrivals['product_id'] ?>">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="img/product/<?= $new_arrivals_img['product_img_path'] ?>">
                                    <span class="label">New</span>
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $new_arrivals['product_name'] ?></h6>
                                    <!-- <a href="#" class="add-cart">+ Add To Cart</a> -->
                                    <del>
                                        <p class="mt-3 del-text"><?= $new_arrivals['product_price_before'] ?> LE</p>
                                    </del>
                                    <h5><?= $new_arrivals['product_price_after'] ?> LE</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- get all data to best sales from database -->
                <?php
                }
                $best_sales_rows = mysqli_query($conn, "SELECT * FROM `best_sales` NATURAL JOIN `products`");
                foreach ($best_sales_rows as $best_sales) {
                    $product_id = $best_sales['product_id'];
                    $best_sales_all_imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = $product_id");
                    $best_sales_img = mysqli_fetch_assoc($best_sales_all_imgs);
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <a href="product-details.php?id=<?= $best_sales['product_id'] ?>">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="img/product/<?= $best_sales_img['product_img_path'] ?>">
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $best_sales['product_name'] ?></h6>
                                    <!-- <a href="#" class="add-cart">+ Add To Cart</a> -->
                                    <del>
                                        <p class="mt-3 del-text"><?= $best_sales['product_price_before'] ?> LE</p>
                                    </del>
                                    <h5><?= $best_sales['product_price_after'] ?> LE</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

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