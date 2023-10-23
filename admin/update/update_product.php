<?php
include "../../PhpConfig/config.php";
include "../../PhpConfig/OOP.php";

$Pid = $_GET['id'];
$products_rows = mysqli_query($conn, "SELECT * FROM `products` WHERE product_id = $Pid");
$product_row = mysqli_fetch_assoc($products_rows);
$product = new Product($Pid, $product_row['product_name'], $product_row['product_desc'], $product_row['product_price_before'], $product_row['product_price_after'], $product_row['category_id']);
$product_all_imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = $Pid");
foreach ($product_all_imgs as $img) {
    $product->setImg($img['product_img_path']);
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

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">
    <link rel="stylesheet" href="../../css/elegant-icons.css" type="text/css">

    <!-- icon -->
    <!-- <link href="all.min.css" rel="stylesheet"> -->
    <!--css links-->
    <link rel="stylesheet" href="../teacher.css">
    <link rel="stylesheet" href="../controls.css">
    <link rel="stylesheet" href="../home.css">
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
                        <a href="#"><img src="../../img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="../home.php">Home</a></li>
                            <li><a href="../products.php">Products</a></li>
                            <li><a href="../login.php">logout</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Shop Details Section Begin -->
    <section class="shop-details mx-lg-5">
        <div class="container">
            <div class="row">
                <?php
                $products_imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = $Pid");
                foreach ($products_imgs as $index => $img) {
                ?>
                    <div class="col-lg-2 col-md-4 col-6">
                        <img class="product__thumb__pic set-bg" src="../../img/product/<?= $img['product_img_path'] ?>">
                    </div>
                <?php } ?>

                <div class="col-lg-2 col-md-4 col-6">
                    <button class="btn btn-success add-pic-button">Add Pic</button>
                </div>
            </div>
            <div class="product__details__content mt-5">
                <div class="container m-auto">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <form action="product-details.php?id=<?= $Pid ?>" method="POST" id="myForm">
                                <div class="product__details__text ">
                                    <div class="form-group">
                                        <label for="exampleInputName">Name</label>
                                        <input type="text" class="form-control text-center" id="exampleInputName" value="<?= $product->getName() ?>" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPriceBefore">Price Before</label>
                                        <input type="text" class="form-control text-center" id="exampleInputPriceBefore" value="<?= $product->getPriceBefore() ?>" name="price_before">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPriceAfter">Price After</label>
                                        <input type="text" class="form-control text-center" id="exampleInputPriceAfter" value="<?= $product->getPriceAfter() ?>" name="price_after">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputDesc">Description</label>
                                        <textarea class="form-control text-center" id="exampleInputDesc" rows="5" name="desc"><?= $product->getDesc() ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mt-4">
                                                <label>Size</label>
                                                <div class="product__details__option">
                                                    <div class="product__details__option__size m-0">
                                                        <?php
                                                        $all_size = mysqli_query($conn, "SELECT * FROM `size`");
                                                        $size_rows = mysqli_query($conn, "SELECT * FROM `product_size` NATURAL JOIN `size` WHERE product_id = $Pid");
                                                        foreach ($all_size as $size) {
                                                        ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="<?= $size['size_name'] ?>" id="<?= $size['size_name'] ?>" <?php foreach ($size_rows as $active) {
                                                                                                                                                                                        if ($active['size_name'] == $size['size_name']) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        }
                                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="<?= $size['size_name'] ?>">
                                                                    <?= $size['size_name'] ?>
                                                                </label>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="product__details__option__color mt-4">
                                                <div class="form-group">
                                                    <span>Colors</span>
                                                    <?php
                                                    $all_colors = mysqli_query($conn, "SELECT * FROM `colors`");
                                                    $color_rows = mysqli_query($conn, "SELECT * FROM `product_colors` NATURAL JOIN `colors` WHERE product_id = $Pid");
                                                    foreach ($all_colors as $color) {
                                                    ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="<?= $color['color_name'] ?>" id="<?= $color['color_name'] ?>" <?php foreach ($color_rows as $active) {
                                                                                                                                                                                        if ($active['color_name'] == $color['color_name']) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        }
                                                                                                                                                                                    } ?>>
                                                            <label style="background-color: <?= $color['color_code'] ?>;" for="<?= $color['color_name'] ?>">
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                    <div id="error_message_color" style="color: red; display: none;">Please select a color.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-success w-50 my-5">Save Change</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Js Plugins -->
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery.nice-select.min.js"></script>
    <script src="../../js/jquery.nicescroll.min.js"></script>
    <script src="../../js/jquery.magnific-popup.min.js"></script>
    <script src="../../js/jquery.countdown.min.js"></script>
    <script src="../../js/jquery.slicknav.js"></script>
    <script src="../../js/mixitup.min.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>