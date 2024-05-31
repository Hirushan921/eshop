<!DOCTYPE html>

<html>

<head>
    <title>eShop | User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



    <div class="container-fluid">
        <div class="row">
            <?php
            session_start();
            require "connection.php";
            if (isset($_SESSION["u"])) {
            ?>

                <div class="col-12 bg-primary">
                    <div class="row bg-white rounded mt-5 mb-5">



                        <div class="col-md-3 border-end">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <?php
                                $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                $pn = $profileimg->num_rows;
                                if ($pn == 1) {
                                    $p = $profileimg->fetch_assoc();
                                ?>
                                    <img class="rounded mt-5" width="150px" src="<?php echo $p["code"]; ?>" id="view"/>
                                <?php
                                } else {
                                ?>
                                    <img class="rounded mt-5" width="150px" src="resources/demoProfileImg.jpg" id="view"/>
                                <?php
                                }
                                ?>
                                <span class="font-weight-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                <span class="text-black-50"><?php echo $_SESSION["u"]["email"]; ?></span>
                                <input type="file" id="profileimg" accept="img/*" class="d-none" />
                                <label class="btn btn-primary mt-3" for="profileimg" onclick="changeUserImage();">Update Profile Image</label>
                            </div>
                        </div>

                        <div class="col-md-5 border-end"> 
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 style="font-weight: bold;">Profile Settings</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">First name</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="first name" value="<?php echo $_SESSION["u"]["fname"]; ?>" id="fname"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last name</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="last name" value="<?php echo $_SESSION["u"]["lname"]; ?>" id="lname"/>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Phone Number" value="<?php echo $_SESSION["u"]["mobile"]; ?>" id="mobile"/>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control form-control-sm" placeholder="Password" readonly value="<?php echo $_SESSION["u"]["password"]; ?>" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Email Address" readonly value="<?php echo $_SESSION["u"]["email"]; ?>" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Registered Date & Time</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Registered Date" readonly value="<?php echo $_SESSION["u"]["register_date"]; ?>" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Gender</label>
                                        <?php
                                        $gen_id = $_SESSION["u"]["gender_id"];
                                        $gen = Database::search("SELECT * FROM `gender` WHERE `id`='" . $gen_id . "'");
                                        $gender = $gen->fetch_assoc();
                                        ?>
                                        <input type="text" class="form-control form-control-sm" placeholder="Gender" readonly value="<?php echo $gender["name"]; ?>" />
                                    </div>
                                    <?php
                                    $useremail = $_SESSION["u"]["email"];
                                    $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $useremail . "'");
                                    $n = $address->num_rows;
                                    if ($n == 1) {
                                        $d = $address->fetch_assoc();
                                    ?>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Address Line 01</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Enter Address Line 01" value="<?php echo $d["line1"] ?>" id="line1"/>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Address Line 02</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Enter Address Line 02" value="<?php echo $d["line2"] ?>" id="line2"/>
                                        </div>
                                </div>
                                <div class=" row">
                                    <?php
                                        $cityid = $d["city_id"];
                                        $ucity = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "'");
                                        $c = $ucity->fetch_assoc();

                                        $districtid = $c["district_id"];
                                        $udist = Database::search("SELECT * FROM `district` WHERE `id`='" . $districtid . "'");
                                        $k = $udist->fetch_assoc();

                                        $provinceid = $k["province_id"];
                                        $uprovince = Database::search("SELECT * FROM `province` WHERE `id`='" . $provinceid . "'");
                                        $l = $uprovince->fetch_assoc();
                                    ?>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Province</label>
                                        <select id="province" class="form-control form-control-sm" id="province">
                                            <option value="<?php echo $l["id"]; ?>"><?php echo $l["name"]; ?></option>
                                            <?php
                                            $provincers = Database::search("SELECT * FROM `province` WHERE `id`!='" . $l["id"] . "' ");
                                            $pn = $provincers->num_rows;
                                            for ($i = 0; $i < $pn; $i++) {
                                                $pr = $provincers->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $pr["id"]; ?>"><?php echo $pr["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">District</label>
                                        <select id="district" class="form-control form-control-sm" id="district">
                                            <option value="<?php echo $k["id"]; ?>"><?php echo $k["name"]; ?></option>
                                            <?php
                                            $districtrs = Database::search("SELECT * FROM `district` WHERE `id`!='" . $k["id"] . "' ");
                                            $kn = $districtrs->num_rows;
                                            for ($j = 0; $j < $kn; $j++) {
                                                $dr = $districtrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $dr["id"]; ?>"><?php echo $dr["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Your City" value="<?php echo $c["name"]; ?>" id="city"/>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Postal Code" value="<?php echo $c["postal_code"]; ?>" id="pcode"/>
                                    </div>
                                <?php
                                    } else {
                                ?>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Address Line 01</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Address Line 01" value="" id="line1"/>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Address Line 02</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Address Line 02" value="" id="line2"/>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Province</label>
                                        <select id="province" class="form-control form-control-sm" id="province">
                                        <option value="0">Select Your Province</option>
                                            <?php
                                            $upro = Database::search("SELECT * FROM `province`;");
                                            $np = $upro->num_rows;
                                            for ($m = 0; $m < $np; $m++) {
                                                $pro = $upro->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $pro["id"]; ?>"><?php echo $pro["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">District</label>
                                        <select id="district" class="form-control form-control-sm" id="district">
                                        <option value="0">Select Your District</option>
                                            <?php
                                            $udis = Database::search("SELECT * FROM `district`;");
                                            $nd = $udis->num_rows;
                                            for ($n = 0; $n < $nd; $n++) {
                                                $dis = $udis->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $dis["id"]; ?>"><?php echo $dis["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Your City" value="" id="city"/>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Postal Code" value="" id="pcode"/>
                                    </div>
                                <?php
                                    }
                                ?>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                                </div>
                                </div>
                            </div>
                        </div>



                    <?php
                } else {
                    ?>
                        <script>
                            window.location = "index.php";
                        </script>
                    <?php
                }
                    ?>


                    <div class="col-md-4">
                        <div class="row">
                            <div class="p-3 py-5">
                                <div class="col-md-12">
                                    <span class="header" style="font-weight: bold;">User Rating</span>
                                    <span class="fa fa-star fs-5 text-warning"></span>
                                    <span class="fa fa-star fs-5 text-warning"></span>
                                    <span class="fa fa-star fs-5 text-warning"></span>
                                    <span class="fa fa-star fs-5 text-warning"></span>
                                    <span class="fa fa-star fs-5 text-secondary "></span>
                                    <p>4.1 average based on 254 reviews.</p>
                                    <hr class="hrbreak1" />
                                </div>
                                <div class="col-md-12">
                                    <span>5 Star</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-end">150</div>
                                    <span>4 Star</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-end">63</div>
                                    <span>3 Star</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-end">15</div>
                                    <span>2 Star</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-end">6</div>
                                    <span>1 Star</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-end">20</div>
                                </div>
                            </div>
                        </div>
                    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>