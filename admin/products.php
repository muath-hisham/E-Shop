<?php
include "../PhpConfig/config.php";
include "../PhpConfig/OOP.php";

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $products_rows = mysqli_query($conn, "SELECT * FROM `products` NATURAL JOIN `categories` WHERE category_name = '$category'");
} else if (isset($_GET['size'])) {
    $size = $_GET['size'];
    $products_rows = mysqli_query($conn, "SELECT * FROM `products` NATURAL JOIN `product_size` NATURAL JOIN `size` WHERE size_name = '$size'");
} else if (isset($_GET['color'])) {
    $color = $_GET['color'];
    $products_rows = mysqli_query($conn, "SELECT * FROM `products` NATURAL JOIN `product_colors` NATURAL JOIN `colors` WHERE color_name = '$color'");
} else {
    $products_rows = mysqli_query($conn, "SELECT * FROM `products`");
}

foreach ($products_rows as $product) {
    $new_product = new Product($product['product_id'], $product['product_name'], $product['product_desc'], $product['product_price_before'], $product['product_price_after'], $product['category_id']);
    $product_id = $product['product_id'];
    $product_all_imgs = mysqli_query($conn, "SELECT * FROM `product_imgs` WHERE product_id = $product_id");
    $img_row = mysqli_fetch_assoc($product_all_imgs);
    $new_product->setImg($img_row['product_img_path']);
    $products[] = $new_product;
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
                        <a href="#"><img src="../img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li class="active"><a href="products.php">Products</a></li>
                            <li><a href="login.php">Log out</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad main">
        <div class="container dashboard">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Website Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">

                            <div class="shop__sidebar p-0">
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
                                                                <li><a href="products.php?category=<?= $category['category_name'] ?>"><?= $category['category_name'] ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            <a href="products.php?size=<?= $size['size_name'] ?>">
                                                                <label><?= $size['size_name'] ?>
                                                                </label>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            <a href="products.php?color=<?= $color['color_name'] ?>">
                                                                <label style="background-color: <?= $color['color_code'] ?>;">
                                                                </label>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <a href="update/add_product.php" class="btn btn-success w-100">Add Product</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div><!-- End Website Traffic -->

                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <?php
                        foreach ($products as $product) {
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="update/update_product.php?id=<?= $product->getId() ?>">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="../img/product/<?= $product->getFirstImg() ?>">
                                        </div>
                                        <div class="product__item__text">
                                            <h6><?= $product->getName() ?></h6>
                                            <del>
                                                <p class="mt-3 del-text"><?= $product->getPriceBefore() ?> LE</p>
                                            </del>
                                            <h5><?= $product->getPriceAfter() ?> LE</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <!-- Js Plugins -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
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