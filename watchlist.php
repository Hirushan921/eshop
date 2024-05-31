<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];

?>
    <!DOCTYPE html>

    <html>

    <head>
        <title>eShop | watchlist</title>
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

                <div class="col-12 border border-1 border-secondary rounded">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-2 fw-bolder">watchlist &hearts;</label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak1">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-2">
                                    <input type="text" class="form-control" placeholder="Search in watchlist..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-2">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hrbreak1">
                        </div>
                        <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                <a class="nav-link" href="#">My Cart</a>
                                <a class="nav-link" href="#">Recently Viewed</a>
                            </nav>
                        </div>

                        <?php
                        $watchlistr = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $uemail . "'");
                        $wn = $watchlistr->num_rows;

                        if ($wn == 0) {
                        ?>
                            <!-- empty watchlist -->
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-12 emptyview"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-2 mb-3 fw-bolder">You have no items in your watchlist</label>
                                    </div>
                                </div>
                            </div>
                            <!-- empty watchlist -->
                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row g-2">
                                    <?php
                                    for ($i = 0; $i < $wn; $i++) {
                                        $wr = $watchlistr->fetch_assoc();
                                        $wid = $wr["product_id"];

                                        $productrs = Database::search("SELECT product.id AS pid,product.title,brand.name AS bname,model.name AS mname, 
                                        color.id AS cid,color.name AS cname,condition.id AS conid,condition.name AS conname,
                                        user.fname,user.lname,user.email,product.price FROM product 
                                        INNER JOIN model_has_brand ON product.model_has_brand_id=model_has_brand.id
                                        INNER JOIN brand ON model_has_brand.brand_id=brand.id
                                        INNER JOIN model ON model_has_brand.model_id=model.id
                                        INNER JOIN color ON product.color_id=color.id
                                        INNER JOIN `condition` ON product.condition_id=`condition`.id
                                        INNER JOIN user ON user.email=product.user_email
                                        WHERE product.id='".$wid."'");
                                        $pr = $productrs->fetch_assoc();

                                    ?>
                                        <div class="card mb-3 mx-0 mx-lg-3 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <?php
                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $wid . "'");
                                                    $in = $imagers->num_rows;
                                                    $arr;
                                                    for ($x = 0; $x < $in; $x++) {
                                                        $ir = $imagers->fetch_assoc();
                                                        $arr[$x] = $ir["code"];
                                                    }
                                                    ?>
                                                    <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start cardtopimg" alt="...">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                                        <span class="fw-bold text-black-50">Colour: <?php echo $pr["cname"]; ?></span>&nbsp; |
                                                        &nbsp;<span class="fw-bold text-black-50">Condition: <?php echo $pr["conname"]; ?></span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-6">Price</span>&nbsp;
                                                        <span class="fw-bolder text-black fs-6">Rs. <?php echo $pr["price"]; ?>.00</span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-6">Seller:</span>
                                                        <br />
                                                        <span class="fw-bolder text-black fs-6"><?php echo $pr["fname"]." ".$pr["lname"]; ?></span>
                                                        <br />
                                                        <span class="fw-bolder text-black fs-6"><?php echo $pr["email"]; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <div class="card-body d-grid">
                                                        <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a href="#" class="btn btn-outline-secondary mb-2">Add Cart</a>
                                                        <a href="#" class="btn btn-outline-danger mb-2" onclick='deletefromwatchlist(<?php echo $wr["id"]; ?>);'>Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

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
    </body>

    </html>

<?php
}
?>