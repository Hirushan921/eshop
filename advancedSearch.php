<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>

<html>

<head>
    <title>eShop | Advanced Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="bg-info">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-body border border-primary border-start-0 border-end-0 border-top-0">
                <?php require "header.php"; ?>
            </div>

            <div class="col-12 bg-white">
                <div class="row">
                    <div class="offest-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2 mt-3">
                                <div class="mb-3 logo"></div>
                            </div>
                            <div class="col-10">
                                <label class="text-black-50 fw-bolder fs-2 mt-5">Advanced Search</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-3 mb-2">
                                <input type="text" class="form-control fw-bold" placeholder="Type keyword to search..." id="k" />
                            </div>
                            <div class="col-12 col-lg-2 mt-3 mb-2">
                                <button class="btn btn-primary searchbtn1" onclick="advancedSearch(1);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-primary border-3" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="c">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $categoryrs = Database::search("SELECT * FROM `category`");
                                            $cn = $categoryrs->num_rows;
                                            for ($a = 0; $a < $cn; $a++) {
                                                $cr = $categoryrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="b">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brandrs = Database::search("SELECT * FROM `brand`");
                                            $bn = $brandrs->num_rows;
                                            for ($a = 0; $a < $bn; $a++) {
                                                $br = $brandrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $br["id"]; ?>"><?php echo $br["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $modelrs = Database::search("SELECT * FROM `model`");
                                            $mn = $modelrs->num_rows;
                                            for ($a = 0; $a < $mn; $a++) {
                                                $mr = $modelrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $mr["id"]; ?>"><?php echo $mr["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="con">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $conditionrs = Database::search("SELECT * FROM `condition`");
                                            $cn =  $conditionrs->num_rows;
                                            for ($a = 0; $a < $cn; $a++) {
                                                $cr = $conditionrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="clr">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $colorrs = Database::search("SELECT * FROM `color`");
                                            $coln =  $colorrs->num_rows;
                                            for ($a = 0; $a < $coln; $a++) {
                                                $colr = $colorrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $colr["id"]; ?>"><?php echo $colr["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price from" id="pf" />
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price to" id="pt" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="offset-o offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <hr>
                            </div>
                            <div class="col-5 offset-7 mb-2 mt-2">
                                <select class=" form-select border border-2 border-dark border-start-0 border-end-0 border-top-0" id="sort">
                                    <option value="0">Sort by price & Quantity</option>
                                    <option value="1">Price Low To High</option>
                                    <option value="2">Price High To Low</option>
                                    <option value="3">Quantity Low To High</option>
                                    <option value="4">Quantity High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3 bg-white mt-1 rounded" id="viewResult">
                <!-- <div class="row" > -->
                <!-- <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" > -->




                <!-- </div>
                    </div> -->

                <!-- <div class="col-12">
                        <div class="row">
                            <div class=" col-12 text-center">
                                <div class="mb-5 pagination">
                                    <a href="#">&laquo;</a>
                                    <a href="#" class="ms-1 active">1</a>
                                    <a href="#" class="ms-1">2</a>
                                    <a href="#">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div> -->

                <!-- </div> -->
            </div>





            <?php
            require "footer.php";
            ?>



        </div>
    </div>





    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>