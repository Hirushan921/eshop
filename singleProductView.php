<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $pn = $productrs->num_rows;

    if ($pn == 1) {
        $pd = $productrs->fetch_assoc();

?>
        <!DOCTYPE html>

        <html>

        <head>
            <title>eShop | Single Product View</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" href="resources/logo.svg" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php
                    require "header.php";
                    ?>

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">

                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-lg-2 order-lg-1 order-2">
                                        <ul>
                                            <?php
                                            $imagesrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                            $in = $imagesrs->num_rows;

                                            $img1;

                                            if (!empty($in)) {
                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $imagesrs->fetch_assoc();

                                                    if ($x == 0) {
                                                        $img1 = $d["code"];
                                                    }

                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" class="mt-1 mb-1" style=" cursor:pointer;" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                    <img src="resources/nophoto.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                    <img src="resources/nophoto.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                    <img src="resources/nophoto.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="align-items-center border border-1 border-secondery p-3">
                                            <div style="background-image: url('<?php echo $img1; ?>'); background-repeat:no-repeat; background-size:contain; height:450px;" id="mainimg"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <nav>
                                                            <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                                <li class="breadcrumb-item">
                                                                    <a href="home.php">Home</a>
                                                                </li>
                                                                <li class="breadcrumb-item active">
                                                                    <a href="#" class="text-black-50 text-decoration-none">Single View</a>
                                                                </li>
                                                            </ol>
                                                        </nav>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                                    </div>
                                                    <div class="col-12 mt-1">
                                                        <span class="badge badge-success">
                                                            <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                            <label class="text-dark fs-7">4.5 Star</label>
                                                            <label class="text-dark fs-7">| 35 Ratings & 45 Reviews</label>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 d-inline-block">
                                                        <label class="fw-bold mt-1 fs-4">Rs. <?php echo $pd["price"]; ?>.00</label>
                                                        <?php $a = $pd["price"];
                                                        $newval = $a + 3000; ?>
                                                        <label class="fw-bold mt-1 fs-6 text-danger"><del>Rs. <?php echo $newval ?>.00</del></label>
                                                    </div>
                                                    <hr class="hrbreak1" />

                                                    <div class="col-lg-6 col-12">
                                                        <label class="text-primary fs-6"><b>Warranty: </b>06 months warrenty</label><br />
                                                        <label class="text-primary fs-6"><b>Return Policy: </b>01 months return policy</label><br />
                                                        <label class="text-primary fs-6"><b>In Stock: </b><?php echo $pd["qty"]; ?> Items</label><br />
                                                        <a href="messages.php?email=<?php echo $pd["user_email"]; ?>" class="btn btn-sm btn-secondary mt-1">Contact Seller</a>
                                                    </div>
                                                    <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                                        <label class="text-dark fs-5 fw-bold">Seller Details</label><br />
                                                        <?php
                                                        $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $pd["user_email"] . "'");
                                                        $userd = $userrs->fetch_assoc();
                                                        ?>
                                                        <label class="text-success fs-6"><b>Name: </b><?php echo $userd["fname"] . " " . $userd["lname"]; ?></label><br />
                                                        <label class="text-success fs-6"><b>Email: </b><?php echo $userd["email"]; ?></label><br />
                                                        <label class="text-success fs-6"><b>Mobile: </b><?php echo $userd["mobile"]; ?></label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-lg-9 col-12 rounded border border-1 border-success mt-2">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-3 col-lg-1">
                                                                        <img src="resources/singleview/pricetag.png" />
                                                                    </div>
                                                                    <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-11">
                                                                        <label class="text-black-50">Stand a chance to get instant 5% discount by using VISA</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="col-12">
                                                        <div class="row" style="margin-top: 5px;">
                                                            <div class="col-md-6" style="margin-top: 5px;">
                                                                <label class="fs-6 mt-1 fw-bold">Colour Options :</label><br />
                                                                <button class="btn btn-primary btn-sm">Black</button>
                                                                <button class="btn btn-primary btn-sm">Gold</button>
                                                                <button class="btn btn-primary btn-sm">Blue</button>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <hr class="hrbreak1 mt-1" />

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <div class="col-md-6" style="margin-top: 15px;">
                                                                <div class="row">
                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start product_qty d-inline-block position-relative">
                                                                        <span class="mt-2">QTY :</span>
                                                                        <input id="qtyinput" class="border-0 fs-6 fw-bold text-start mt-2" type="text" pattern="[0-9]*" value="1" />
                                                                        <div class="position-absolute qty-buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                                <i class="fas fa-chevron-up" onclick="qty_inc(<?php echo $pd['qty']; ?>);"></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                                <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" col-12 mt-2 ">
                                                                <div class="row">
                                                                    <div class="col-4 d-grid ">
                                                                        <button class="btn btn-primary">Add to cart</button>
                                                                    </div>
                                                                    <div class="col-4 d-grid">
                                                                        <button class="btn btn-success" id="payhere-payment" type="submit" onclick="paynow(<?php echo $pid; ?>);">Buy Now</button>
                                                                    </div>
                                                                    <div class="col-4 col-lg-2">
                                                                        <i class="fas fa-heart ms-1 fs-4 text-black-50"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row p-2">
                                            <?php
                                            $brandrs = Database::search("SELECT model_has_brand.brand_id FROM product 
                                              INNER JOIN model_has_brand ON product.model_has_brand_id=model_has_brand.id
                                              WHERE model_has_brand.id='" . $pd["model_has_brand_id"] . "' ");
                                            $bd = $brandrs->fetch_assoc();
                                            $bid = $bd["brand_id"];

                                            $rpro = Database::search("SELECT product.id AS pid,product.title,product.price FROM product 
                                              INNER JOIN model_has_brand ON product.model_has_brand_id=model_has_brand.id
                                              WHERE model_has_brand.brand_id='" . $bid . "' LIMIT 4;");
                                            $rpn = $rpro->num_rows;

                                            for ($q = 0; $q < $rpn; $q++) {
                                                $relpro = $rpro->fetch_assoc();
                                            ?>
                                                <div class="card  col-lg-2 col-6">
                                                    <?php
                                                    $imgs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $relpro["pid"] . "'");
                                                    $ir = $imgs->fetch_assoc();
                                                    ?>
                                                    <img src="<?php echo $ir["code"]; ?>" class="card-img-top cardtopimg" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $relpro["title"]; ?></h5>
                                                        <p class="card-text">Rs. <?php echo $relpro["price"]; ?>.00</p>
                                                        <a href="#" class="btn btn-primary col-9">Add to cart</a>
                                                        <a class="ms-2 mt-1 fs-5 col-2"><i class="fas fa-heart  fs-4 text-black-50"></i></a>
                                                        <a href='<?php echo "singleProductView.php?id=" . ($relpro["pid"]); ?>' class="btn btn-primary col-12 mt-1">Buy Now</a>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">
                                    <?php
                                    $bm = Database::search("SELECT brand.name AS bname,model.name AS mname FROM product 
                                          INNER JOIN model_has_brand ON product.model_has_brand_id=model_has_brand.id
                                          INNER JOIN brand ON brand.id=model_has_brand.brand_id
                                          INNER JOIN model ON model.id=model_has_brand.model_id
                                          WHERE model_has_brand.id='" . $pd["model_has_brand_id"] . "' ");
                                    $bmr = $bm->fetch_assoc();
                                    ?>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-1">
                                                <label class="form-label fw-bold">Brand :</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $bmr["bname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-1">
                                                <label class="form-label fw-bold">Model :</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $bmr["mname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <label class="form-label fw-bold">Description :</label>
                                            </div>
                                            <div class="col-12 col-lg-10">
                                                <textarea class="form-control" cols="60" rows="10" readonly><?php echo $pd["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Feedbacks...</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row g-1">
                            <?php
                            $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                            $feed = $feedbackrs->num_rows;
                            if ($feed == 0) {
                            ?>
                                <div class="col-12">
                                    <label class="form-label fs-3 text-center text-black-50">There ara no feedbacks to view</label>
                                </div>
                            <?php
                            }else{
                                for($a=0;$a<$feed;$a++){
                                    $feedrow=$feedbackrs->fetch_assoc();
                                    $feedmail = $feedrow["user_email"];
                            ?>
                            <div class="col-12 col-lg-4 border border-1 border-danger rounded">
                                <div class="row">
                                    <?php
                                    $feeduser = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedmail . "'");
                                    $fu = $feeduser->fetch_assoc();
                                    ?>
                                    <div class="col-12">
                                        <span class="fs-6 fw-bold text-dark"><?php echo $fu["fname"] . " " . $fu["lname"]; ?></span>
                                    </div>
                                    <div class="col-12">
                                        <span class="fs-6 fw-bold text-primary"><?php echo $feedrow["feed"]; ?></span>
                                    </div>
                                    <div class="col-12 text-end">
                                        <span class="fs-7 fw-bold text-black-50"><?php echo $feedrow["date"]; ?></span>
                                    </div>
                                </div>
                            </div>

                            <?php
                             }
                            }
                            ?>

                        </div>
                    </div>



                    <?php
                    require "footer.php";
                    ?>


                </div>
            </div>






            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="script.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php
    }
}
?>