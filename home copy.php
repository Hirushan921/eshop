<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>eShop Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- header -->
            <?php
            require "header.php";
            ?>
            <!-- header -->

            <hr class="hrbreak1" />
            <!-- logo and search bar  -->
            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="col-12 offset-lg-1 col-lg-1 logoimg" style="background-position: center;"></div>
                    <div class="col-7 col-lg-6">
                        <div class="input-group  mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

                            <select class="btn btn-outline-primary col-lg-4 col-6" id="basic_search_select">
                                <option value="0">Category</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;
                                for ($i = 0; $i < $n; $i++) {
                                    $cat = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-primary mt-3 searchbtn" onclick="basicSearch();">Search</button>
                    </div>
                    <div class="col-2 mt-4 ms-2 ms-lg-0">
                        <a class="link-secondary linkadvanced" href="advancedSearch.php">Advanced</a>
                    </div>
                </div>
            </div>
            <!-- logo and search bar  -->

            <hr class="hrbreak1" />

            <!-- img slide -->
            <div class="col-12 d-none d-lg-block" id="imgslide">
                <div class="row">
                    <div id="carouselExampleCaptions" class="carousel slide offset-2 col-8" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/slider images/posterimg.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption">
                                    <h5 class="postertitle">Welcome to eShop</h5>
                                    <p class="postertxt">The World's Best Online Store By One Click</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg2.jpg" class="d-block posterimg1" alt="...">
                                <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div> -->
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg3.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption1">
                                    <h5 class="postertitle">Be free.....</h5>
                                    <p class="postertxt">Experience the Lowest Delivery Costs With Us.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- img slide -->

            <div class="col-12" id="sdetails">
            
            </div>

            <!--product cards -->
            <?php
            $cat = Database::search("SELECT * FROM `category`");
            $n = $cat->num_rows;
            for ($X = 0; $X < $n; $X++) {
                $c = $cat->fetch_assoc();
            ?>
                <div class="col-12 mt-3">
                    <a class="link-dark link2" href="#"><?php echo $c["name"]; ?></a>&nbsp;&nbsp;
                    <a class="link-dark link3" href="#">See All &rightarrow;</a>
                </div>

                <?php
                $resultset = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c["id"] . "' ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0");
                $nr = $resultset->num_rows;
                ?>

                <div class="row mt-2 mb-5">
                    <div class="col-12">
                        <div class="row ms-2 border border-primary ps-lg-5">

                            <?php
                            for ($y = 0; $y < $nr; $y++) {
                                $prod = $resultset->fetch_assoc();
                            ?>
                                <div class="card mt-2 mb-2 col-6 col-lg-2 ms-lg-4">
                                    <?php
                                    $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prod["id"] . "'");
                                    $img = $pimage->fetch_assoc();
                                    ?>
                                    <img src="<?php echo $img["code"]; ?>" class="card-img-top cardtopimg" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $prod["title"]; ?><br /><span class="badge bg-info">New</span></h5>
                                        <span class="card-text text-primary">RS.<?php echo $prod["price"]; ?>.00</span>
                                        <br />
                                        <?php
                                        if ((int)$prod["qty"] > 0) {
                                        ?>
                                            <span class="card-text text-warning">In Stock</span>
                                            <input class="form-control mb-2" type="number" value="<?php echo $prod["qty"]; ?>" />
                                            <a href='<?php echo "singleProductView.php?id=" . ($prod["id"]); ?>' class="btn btn-success col-8 mb-1 ">Buy Now</a>
                                            <a href="#" class="btn btn-secondary col-3 ms-2  mb-1" onclick='addToWatchlist(<?php echo $prod["id"]; ?>);'><i class="bi bi-heart-fill"></i></a>
                                            <a href="#" class="btn btn-danger col-12">Add To Cart</a>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="card-text text-warning">Out of Stock</span>
                                            <input class="form-control mb-1" type="number" value="0" disabled/>
                                            <a href="#" class="btn btn-success col-12 mb-1" disabled>Buy Now</a>
                                            <a href="#" class="btn btn-danger col-12" disabled>Add To Cart</a>
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
                </div>
            <?php
            }
            ?>
            <!-- cards -->


            <!-- footer -->
            <?php
            require "footer.php";
            ?>
            <!-- footer -->


        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>