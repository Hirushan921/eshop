<?php
require "connection.php";

session_start();
if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | Seller's Product View</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!-- head -->
                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 mb-1">
                                    <?php
                                    $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $user["email"] . "'");
                                    $pn = $profileimg->num_rows;
                                    if ($pn == 1) {
                                        $pr = $profileimg->fetch_assoc();
                                    ?>
                                        <img class="rounded-circle" src="<?php echo $pr["code"]; ?>" height="85px" width="80px" />
                                    <?php
                                    } else {
                                    ?>
                                        <img class="rounded-circle" src="resources/demoProfileImg.jpg" height="90px" width="90px" />
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="fw-bold"><?php echo $user["fname"] . " " . $user["lname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white"><?php echo $user["email"]; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 mt-5 mt-lg-3">
                                    <h1 class="text-white fw-bold offset-5 offset-lg-2">My Products</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- head -->



                <div class="col-12">
                    <div class="row">

                        <!-- sortings -->
                        <div class="col-11 col-lg-2 mx-3 mx-lg-3 my-3 rounded bg-body border border-primary">
                            <div class="row">
                                <div class="col-12 mt-3 ms-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-9">
                                                    <input class="form-control" type="text" placeholder="Search.." id="s" />
                                                </div>
                                                <div class="col-1">
                                                    <label class="form-label fs-4 bi bi-search"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault1" id="n">
                                                <label class="form-check-label fs-5" for="flexRadioDefault1">
                                                    Newer to Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault1" id="o">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Oldest to Newer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault2" id="h">
                                                <label class="form-check-label fs-5" for="flexRadioDefault2">
                                                High to Low
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" id="l">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                   Low to High
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault3" id="b">
                                                <label class="form-check-label fs-5" for="flexRadioDefault3">
                                                    Brand New
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault3" id="u">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                        <div class="offset-0 offset-lg-1 col-11 col-lg-8 mt-4 mb-3 mb-lg-3 d-grid">
                                            <div class="row">
                                                <button class="col-12 btn btn-success fw-bold mb-3" onclick="addFilters(1);">Search</button>
                                                <button class="col-12 btn btn-primary" onclick="clearFilters();">Clear Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- sortings -->
                        
                        <!-- product -->
                        <div class="col-12 col-lg-9 mt-3 mb-3 ms-lg-4 bg-white border border-primary" id="filterdiv">
                            <div class="row">
                                <div class="offset-1 col-10 text-center" >
                                    <div class="row" >
                                        <?php
                                        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ");
                                        $d = $products->num_rows;
                                        $row = $products->fetch_assoc();

                                        $results_per_page = 6;

                                        $number_of_pages = ceil($d / $results_per_page);
                                        $pageno;
                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $offset = ($pageno - 1) * $results_per_page;

                                        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' LIMIT  $results_per_page OFFSET $offset");
                                        $srn = $selectedrs->num_rows;

                                        while ($srow = $selectedrs->fetch_assoc()) {

                                        ?>
                                            <div class="card mb-3 col-lg-5 col-12 mt-3 ms-lg-5 ms-0">
                                                <div class="row g-0">
                                                    <?php
                                                    $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $srow["id"] . "'");
                                                    $pir = $pimgrs->fetch_assoc();
                                                    ?>
                                                    <div class="col-md-4 mt-4">
                                                        <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $srow["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-primary">Rs. <?php echo $srow["price"]; ?>.00</span>
                                                            <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $srow["qty"]; ?> Items Left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="check" onchange='changeStatus(<?php echo $srow["id"]; ?>);' <?php
                                                                                                                                                                                                if ($srow["status_id"] == 2) {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?> />
                                                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $srow["id"]; ?>">
                                                                    <?php
                                                                    if ($srow["status_id"] == 2) {
                                                                        echo "Activate Product";
                                                                    } else {
                                                                        echo "Deactivate Product";
                                                                    }
                                                                    ?>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-6">
                                                                        <a href="#" class="btn btn-success d-grid" onclick='sendid(<?php echo $srow["id"]; ?>)'>Update</a>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                        <a href="#" class="btn btn-danger d-grid" onclick='deleteModal(<?php echo $srow["id"]; ?>);'>Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal<?php echo $srow["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bolder text-warning" id="exampleModalLabel">Warning...</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are You Sure You Want To Delete This Product?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-danger" onclick='deleteproduct(<?php echo $srow["id"]; ?>);'>Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                                <!-- pagination -->
                                <div class="col-12 mb-3 mt-3">
                                    <div class="pagination d-flex justify-content-center">
                                        <a href="<?php
                                                    if ($pageno <= 1) {
                                                        echo "#";
                                                    } else {
                                                        echo "?page=" . ($pageno - 1);
                                                    }
                                                    ?>">&laquo;</a>
                                        <?php
                                        for ($page = 1; $page <= $number_of_pages; $page++) {
                                            if ($page == $pageno) {
                                        ?>
                                                <a href="sellerproductview.php?page=<?php echo $page; ?>" class="ms-1 active"><?php echo $page; ?></a>
                                                <!-- <a href="<?php echo "?page=" . $page; ?>"><?php echo $page; ?></a> -->
                                            <?php
                                            } else {
                                            ?>
                                                <a href="sellerproductview.php?page=<?php echo $page; ?>" class="ms-1"><?php echo $page; ?></a>
                                                <!-- <a href="<?php echo "?page=" . $page; ?>"><?php echo $page; ?></a> -->
                                        <?php
                                            }
                                        }
                                        ?>
                                        <a href="<?php
                                                    if ($pageno >= $number_of_pages) {
                                                        echo "#";
                                                    } else {
                                                        echo "?page=" . ($pageno + 1);
                                                    }
                                                    ?>">&raquo;</a>
                                    </div>
                                </div>
                                <!-- pagination -->

                            </div>
                        </div>
                        <!-- product -->
                        
                    </div>
                </div>



                <!-- footer -->
                <?php
                require "footer.php";
                ?>
                <!-- footer -->


            </div>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>






<?php
} else {
?>
    <script>
        alert("You have to Sign In or Sign Up First");
        window.location = "index.php"
    </script>
<?php
}
?>