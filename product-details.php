<?php
include "PhpConfig/config.php";
include "PhpConfig/OOP.php";

$Pid = $_GET['id'];
$products_rows = mysqli_query($conn, "SELECT * FROM `products` WHERE product_id = $Pid");
$product_row = mysqli_fetch_assoc($products_rows);
$product = new Product($Pid, $product_row['product_name'], $product_row['product_desc'], $product_row['product_price_before'], $product_row['product_price_after'], $product_row['category_id']);
$product_all_imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = $Pid");
foreach ($product_all_imgs as $img) {
    $product->setImg($img['product_img_path']);
}

if (isset($_POST['size'])) {
    $size = $_POST['size'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];

    $productBuyed = new ProductBuyed($product, $size, $color, $quantity);
    $serializedData = serialize($productBuyed);
    insertItem($serializedData);

    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>the product</strong> added to the cart
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
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
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

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
                            <li class="active"><a href="./shop.php">Shop</a></li>
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
    <section class="breadcrumb-option mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Details Section Begin -->
    <section class="shop-details mx-lg-5">
        <div class="row">
            <div class="product__details__pic col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php
                                $products_imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = $Pid");
                                foreach ($products_imgs as $index => $img) {
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-<?= $index ?>" role="tab">
                                            <div class="product__thumb__pic set-bg" data-setbg="img/product/<?= $img['product_img_path'] ?>">
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-9">
                            <div class="tab-content">
                                <?php
                                foreach ($products_imgs as $index => $img) {
                                ?>
                                    <div class="tab-pane <?php if ($index == 0) echo "active" ?>" id="tabs-<?= $index ?>" role="tabpanel">
                                        <div class="product__details__pic__item">
                                            <img src="img/product/<?= $img['product_img_path'] ?>" alt="">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__details__content col-lg-6 mt-lg-5">
                <div class="container m-auto">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <form action="product-details.php?id=<?= $Pid ?>" method="POST" id="myForm">
                                <div class="product__details__text">
                                    <h4><?= $product->getName() ?></h4>
                                    <h3><?= $product->getPriceBefore() ?> LE <span><?= $product->getPriceAfter() ?></span></h3>
                                    <p><?= $product->getDesc() ?></p>
                                    <div class="product__details__option">
                                        <div class="product__details__option__size">
                                            <span>Size:</span>
                                            <?php
                                            $size_rows = mysqli_query($conn, "SELECT * FROM `product_size` NATURAL JOIN `size` WHERE product_id = $Pid");
                                            foreach ($size_rows as $size) {
                                            ?>
                                                <label for="<?= $size['size_name'] ?>"><?= $size['size_name'] ?>
                                                    <input type="radio" id="<?= $size['size_name'] ?>" name="size" value="<?= $size['size_name'] ?>">
                                                </label>
                                            <?php } ?>
                                            <div id="error_message_size" style="color: red; display: none;">Please select a size.</div>
                                        </div>
                                        <div class="product__details__option__color mt-4">
                                            <span>Color:</span>
                                            <?php
                                            $color_rows = mysqli_query($conn, "SELECT * FROM `product_colors` NATURAL JOIN `colors` WHERE product_id = $Pid");
                                            foreach ($color_rows as $color) {
                                            ?>
                                                <label style="background-color: <?= $color['color_code'] ?>;" for="<?= $color['color_name'] ?>">
                                                    <input type="radio" id="<?= $color['color_name'] ?>" name="color" value="<?= $color['color_code'] ?>">
                                                </label>
                                            <?php } ?>
                                            <div id="error_message_color" style="color: red; display: none;">Please select a color.</div>
                                        </div>
                                    </div>
                                    <div class="product__details__cart__option">
                                        <div class="quantity w-100">
                                            <button class="btn btn-danger" id="decreaseButton">-</button>
                                            <div class="mx-3" style="display: inline;">
                                                <input type="number" id="numericalInput" name="quantity" value="1" style="width: 150px; height: 35px; text-align: center;">
                                            </div>
                                            <button class="btn btn-success" id="increaseButton">+</button>
                                        </div>
                                        <div class="mt-4">
                                            <input type="submit" class="btn btn-success primary-btn2" value="Add To Cart">
                                            <a href="#" class="btn btn-info primary-btn2">Buy Now</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

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
    <script>
        // Get references to the input field and buttons
        const numericalInput = document.getElementById('numericalInput');
        const increaseButton = document.getElementById('increaseButton');
        const decreaseButton = document.getElementById('decreaseButton');

        // Add click event listeners to the buttons
        increaseButton.addEventListener('click', () => {
            numericalInput.value = parseInt(numericalInput.value) + 1;
        });

        decreaseButton.addEventListener('click', () => {
            const currentValue = parseInt(numericalInput.value);
            if (currentValue > 1) {
                numericalInput.value = currentValue - 1;
            }
        });
    </script>
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
    <script>
        $(document).ready(function() {
            // Function to handle radio button click event
            $(".product__details__option__color input[type='radio']").click(function() {
                // Remove "active" class from all labels
                $(".product__details__option__color label").removeClass("active");

                // Add "active" class to the label associated with the selected radio button
                $(this).closest("label").addClass("active");
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#myForm").submit(function(event) {
                // Check if no radio button is checked
                if (!$("input[name='size']:checked").length > 0) {
                    event.preventDefault(); // Prevent form submission
                    $("#error_message_size").show(); // Show the error message
                } else {
                    $("#error_message_size").hide();
                }

                if (!$("input[name='color']:checked").length > 0) {
                    event.preventDefault(); // Prevent form submission
                    $("#error_message_color").show(); // Show the error message
                } else {
                    $("#error_message_color").hide();
                }
            });
        });
    </script>
</body>

</html>