<?php
session_start();
require "connection.php";

$from = $_GET["f"];
$to = $_GET["t"];

// echo $from;
// echo $to;
?>

<!DOCTYPE html>

<html>

<head>
    <title>eShop | Products Selling History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%); min-height:100vh;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Products Selling History</label>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <div class="col-3 col-lg-2  bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">Order ID</span>
                    </div>
                    <div class="col-6 col-lg-3 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold">Product</span>
                    </div>
                    <div class="col-6 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Buyer</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>
                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 ">
                        <span class="fs-4 fw-bold text-white">Quantity</span>
                    </div>
                </div>
            </div>

            <?php
            if (!empty($from) && empty($to)) {
                $fromrs = Database::search("SELECT * FROM `invoice`");
                $fn = $fromrs->num_rows;

                for ($x = 0; $x < $fn; $x++) {
                    $fr = $fromrs->fetch_assoc();

                    $fromdate = $fr["date"];
                    $splitdate = explode(" ", $fromdate);
                    $date = $splitdate[0];

                    if ($from == $date) {
            ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                    <span class="fs-5 fw-bold text-white"><?php echo $fr["order_id"]; ?></span>
                                </div>
                                <?php
                                $prors = Database::search("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "'");
                                $pro = $prors->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-light pt-2 pb-2 ">
                                    <span class="fs-5 fw-bold"><?php echo $pro["title"]; ?></span>
                                </div>
                                <?php
                                $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "'");
                                $us = $userrs->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-white"><?php echo $us["fname"]." ".$us["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold">Rs. <?php echo $fr["total"]; ?>.00</span>
                                </div>
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                                    <span class="fs-5 fw-bold text-white"><?php echo $fr["qty"]; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
            } elseif (!empty($from) && !empty($to)) {
                $betweenrs = Database::search("SELECT * FROM `invoice`");
                $bn = $betweenrs->num_rows;


                for ($y = 0; $y < $bn; $y++) {
                    $br = $betweenrs->fetch_assoc();

                    $betweendate = $br["date"];
                    $splitdate = explode(" ", $betweendate);
                    $date = $splitdate[0];

                    if ($from <= $date && $to >= $date) {
                    ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                    <span class="fs-5 fw-bold text-white"><?php echo $br["order_id"]; ?></span>
                                </div>
                                <?php
                                $prors2 = Database::search("SELECT * FROM `product` WHERE `id`='" . $br["product_id"] . "'");
                                $pro2 = $prors2->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-light pt-2 pb-2 ">
                                    <span class="fs-5 fw-bold"><?php echo $pro2["title"]; ?></span>
                                </div>
                                <?php
                                $userrs2 = Database::search("SELECT * FROM `user` WHERE `email`='" . $br["user_email"] . "'");
                                $us2 = $userrs2->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-white"><?php echo $us2["fname"]." ".$us2["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold">Rs. <?php echo $br["total"]; ?>.00</span>
                                </div>
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                                    <span class="fs-5 fw-bold text-white"><?php echo $br["qty"]; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
            } else {
                $todayrs = Database::search("SELECT * FROM `invoice`");
                $tn = $todayrs->num_rows;

                for ($z = 0; $z < $tn; $z++) {
                    $tr = $todayrs->fetch_assoc();

                    $nodate = $tr["date"];
                    $splitdate = explode(" ", $nodate);
                    $date = $splitdate[0];

                    $today = date("Y-m-d");

                    if ($today == $date) {
                    ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                    <span class="fs-5 fw-bold text-white"><?php echo $tr["order_id"]; ?></span>
                                </div>
                                <?php
                                $prors3 = Database::search("SELECT * FROM `product` WHERE `id`='" . $tr["product_id"] . "'");
                                $pro3 = $prors3->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-light pt-2 pb-2 ">
                                    <span class="fs-5 fw-bold"><?php echo $pro3["title"]; ?></span>
                                </div>
                                <?php
                                $userrs3 = Database::search("SELECT * FROM `user` WHERE `email`='" . $tr["user_email"] . "'");
                                $us3 = $userrs3->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-white"><?php echo $us3["fname"]." ".$us3["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold">Rs. <?php echo $tr["total"]; ?>.00</span>
                                </div>
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                                    <span class="fs-5 fw-bold text-white"><?php echo $tr["qty"]; ?></span>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>





            <div style="margin-top: 200px;">
                <?php require "footer.php"; ?>
            </div>


        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>