<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {



?>


    <!DOCTYPE html>

    <html>

    <head>
        <title>eShop | Admin | Panel</title>
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

                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="align-items-start bg-dark col-12 text-center">
                            <div class="row g-1">
                                <div class="col-12 mt-5">
                                    <h5 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h5>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                        <a class="nav-link active fs-5" aria-current="page" href="#">Dashbord</a>
                                        <a class="nav-link fs-5" href="manageusers.php">Manage Users</a>
                                        <a class="nav-link fs-5" href="manageproducts.php">Manage Products</a>
                                    </nav>
                                </div>
                                <div class="col-12 mt-3">
                                    <hr class="border border-1 border-white" />
                                    <h5 class="text-white" style="cursor:pointer">Selling History</h5>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="col-12 mt-3 d-grid">
                                    <label class="form-label text-white fs-6">From Date</label>
                                    <input type="date" class="form-control" id="fromdate"/>
                                    <label class="form-label text-white fs-6 mt-2">To Date</label>
                                    <input type="date" class="form-control" id="todate"/>
                                    <a href="" id="historylink" class="btn btn-primary mt-2" onclick="dailysellings();">View Sellings</a>
                                    <hr class="border border-1 border-white" />
                                    <!-- <a href="ProductsSellingHistory.php" class="text-white fs-5" style="cursor:pointer; text-decoration:none;">Daily Sellings</a> -->
                                    <hr class="border border-1 border-white" />
                                    <hr class="border border-1 border-white" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-12 mt-3 mb-2 text-white">
                            <h2 class="w-bold">Dashboard</h2>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">
                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <?php
                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoicers = Database::search("SELECT * FROM `invoice`");
                                            $in = $invoicers->num_rows;

                                            for ($x = 0; $x < $in; $x++) {
                                                $ir = $invoicers->fetch_assoc();

                                                $f = $f + $ir["qty"];

                                                $d = $ir["date"];
                                                $splitdate = explode(" ", $d);
                                                $pdate = $splitdate[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $ir["total"];
                                                    $c = $c + $ir["qty"];
                                                }

                                                $splitmonth = explode("-", $pdate);
                                                $pyear = $splitmonth[0];
                                                $pmonth = $splitmonth[1];

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $ir["total"];
                                                        $e = $e + $ir["qty"];
                                                    }
                                                }
                                            }
                                            ?>
                                            <span class="fs-5">Rs. <?php echo $a; ?>.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-light text-dark text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $b; ?>.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Selling</span>
                                            <br />
                                            <span class="fs-5"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Selling</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Selling</span>
                                            <br />
                                            <span class="fs-5"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />
                                            <?php
                                            $usersrs = Database::search("SELECT * FROM `user`");
                                            $un = $usersrs->num_rows;
                                            ?>
                                            <span class="fs-5"><?php echo $un; ?> Members</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-12 col-lg-3 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>
                                <?php
                                $startdate = new DateTime("2021-10-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $endDate = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $endDate->diff($startdate);
                                ?>
                                <div class="col-12 col-lg-9 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-success">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%M') . " Months " . $difference->format('%d') . " Days " .
                                            $difference->format('%H') . " Hours " . $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">
                                <?php
                                $freq = Database::search("SELECT `user_email`,COUNT(`qty`) AS `totalqty`,`product_id`,COUNT(`product_id`) AS `value_occurrence`
                                 FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence`
                                 DESC LIMIT 1");

                                $freqnum = $freq->num_rows;

                                for ($z = 0; $z < $freqnum; $z++) {
                                    $freqrow = $freq->fetch_assoc();
                                    $proid = $freqrow["product_id"];
                                    $umail = $freqrow["user_email"];
                                }
                                ?>
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                </div>
                                <?php
                                $prodata = Database::search("SELECT * FROM `product` WHERE `id`='" . $proid . "'");
                                $prod = $prodata->fetch_assoc();
                                $img = Database::search("SELECT * FROM `images` WHERE `product_id`='".$prod["id"]."'");
                                $pimg = $img->fetch_assoc();
                                ?>
                                <div class="col-12 text-center">
                                    <img src="<?php echo $pimg["code"]; ?>" class="img-fluid rounded-top " />
                                    <hr />
                                </div>
                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold"><?php echo $prod["title"] ?></span>
                                    <br />
                                    <span class="fs-6"><?php echo $freqrow["totalqty"]; ?> Items</span>
                                    <br />
                                    <span class="fs-6">Rs. <?php echo $prod["price"] ?>.00</span>
                                </div>
                                <div class="firstplace"></div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mostly Famous Seller</label>
                                </div>
                                <?php
                                $udata = Database::search("SELECT * FROM `user` WHERE `email`='" . $umail . "'");
                                $u = $udata->fetch_assoc();
                                $uimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$umail."'");
                                $ui = $uimg->fetch_assoc();
                                ?>
                                <div class="col-12 text-center">
                                    <img src="<?php echo $ui["code"]; ?>" class="img-fluid rounded-top cardtopimg"  />
                                    <hr />
                                </div>
                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold"><?php echo $u["fname"]." ".$u["lname"]; ?></span>
                                    <br />
                                    <span class="fs-6"><?php echo $umail; ?></span>
                                    <br />
                                    <span class="fs-6"><?php echo $u["mobile"]; ?></span>
                                </div>
                                <div class="firstplace"></div>
                            </div>
                        </div>

                    </div>
                </div>







                <?php require "footer.php"; ?>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>