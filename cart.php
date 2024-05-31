<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = "0";

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>eShop | Cart</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">


                <?php
                require "header.php";
                ?>

                <div class="col-12" style="background-color: #E3E4E5;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Basket</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-secondary rounded mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-2 fw-bolder">Basket <i class="bi bi-cart3"></i></label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak1">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-2">
                                    <input type="text" class="form-control" placeholder="Search in basket..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-2">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hrbreak1">
                        </div>

                        <?php
                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "'");
                        $cn = $cartrs->num_rows;

                        if ($cn == 0) {
                        ?>
                            <!-- empty cart  -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-2 fw-bolder">You have no items in your basket.</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="#" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                            <!-- empty cart  -->
                        <?php
                        } else {
                        ?>
                            <div class="col-lg-9 col-12">
                                <div class="row">

                                    <?php
                                    for ($i = 0; $i < $cn; $i++) {
                                        $cr = $cartrs->fetch_assoc();

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cr["product_id"] . "'");
                                        $pr = $productrs->fetch_assoc();

                                        $total = $total + ($pr["price"] * $cr["qty"]);

                                        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                        $ar = $addressrs->fetch_assoc();
                                        $cityid = $ar["city_id"];

                                        $addis = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "'");
                                        $ad = $addis->fetch_assoc();
                                        $districtid = $ad["district_id"];

                                        $ship = 0;
                                        if ($districtid == "21") {
                                            $ship = $pr["delivery_fee_colombo"];
                                            $shipping = $shipping + $pr["delivery_fee_colombo"];
                                        } else {
                                            $ship = $pr["delivery_fee_other"];
                                            $shipping = $shipping + $pr["delivery_fee_other"];
                                        }

                                        $sellerrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $pr["user_email"] . "'");
                                        $sn = $sellerrs->fetch_assoc();

                                    ?>

                                        <div class="card mb-3 ms-lg-2 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-6">Seller:</span>&nbsp;
                                                            <span class="fw-bolder text-black fs-6"><?php echo $sn["fname"] . " " . $sn["lname"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="col-md-4">
                                                    <?php
                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pr["id"] . "'");
                                                    $in = $imagers->num_rows;
                                                    $arr;
                                                    for ($x = 0; $x < $in; $x++) {
                                                        $ir = $imagers->fetch_assoc();
                                                        $arr[$x] = $ir["code"];
                                                    }
                                                    ?>
                                                    <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start cardtopimg d-inline-block" 
                                                    tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $pr["title"]; ?>" 
                                                    data-bs-content="<?php echo $pr["description"]; ?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h5 class="card-title fw-bold text-black"><?php echo $pr["title"]; ?></h5>
                                                        <?php
                                                        $cc = Database::search("SELECT color.id AS cid,color.name AS cname,condition.id AS conid,condition.name AS conname FROM product
                                                        INNER JOIN color ON product.color_id=color.id
                                                        INNER JOIN `condition` ON product.condition_id=`condition`.id WHERE product.id='" . $pr["id"] . "'");
                                                        $clco = $cc->fetch_assoc();
                                                        ?>
                                                        <span class="fw-bold text-black-50">Colour: <?php echo $clco["cname"]; ?></span>&nbsp; |
                                                        &nbsp;<span class="fw-bold text-black-50">Condition: <?php echo $clco["conname"]; ?></span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-6">Price</span>&nbsp;
                                                        <span class="fw-bolder text-black fs-6">Rs. <?php echo $pr["price"]; ?>.00</span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-6">Quantity</span>&nbsp;
                                                        <input type="text" value="<?php echo $cr["qty"]; ?>" class="mt-2 mb-2 border border-2 border-secondary fs-6 fw-bold px-3 cartqtytxt" />
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-6">Delivery Fee</span>&nbsp;
                                                        <span class="fw-bolder text-black fs-6">Rs. <?php echo $ship; ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <div class="card-body d-grid">
                                                        <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick='deletefromcart(<?php echo $cr["id"]; ?>);'>Remove</a>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="col-md-12 mt-2 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs. <?php echo $pr["price"] * $cr["qty"] + $shipping; ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fs-4 fw-bold">Summary</label>
                                    </div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Items (<?php echo $cn; ?>)</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?>.00</span>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>
                                    <div class="col-6 text-end mt-2">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?>.00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>
                                    <div class="col-6 mt-3">
                                        <span class="fs-5 fw-bold">Total</span>
                                    </div>
                                    <div class="col-6 text-end mt-3">
                                        <span class="fs-5 fw-bold">Rs. <?php echo $total + $shipping; ?>.00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>
                                    <div class="col-12 mt-1 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }
                        ?>




                    </div>
                </div>







                <?php
                require "footer.php";
                ?>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

    </html>

<?php
}
?>