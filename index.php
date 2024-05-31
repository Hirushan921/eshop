<!DOCTYPE html>

<html>

<head>
    <title>eShop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="main-background">

    <div class="container-fluid vh-100 d-flex justify-content-center">

        <div class="row align-content-center">

            <!-- logo and main title -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to eShop</p>
                    </div>
                </div>
            </div>
            <!-- logo and main title -->

            <!-- image and fields -->
            <div class="col-12 px-5 py-4">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background">
                    </div>
                    <!-- sign up -->
                    <div class="col-12 col-lg-6" id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title2">Create New Account</p>
                                <p class="text-danger" id="msg"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" id="fname" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" id="lname" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="text" id="email" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input class="form-control" type="text" id="mobile" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender">
                                    <?php
                                    require "connection.php";
                                    $r = Database::search("SELECT * FROM `gender`");
                                    $n = $r->num_rows;
                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $r->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $d['id']; ?>"><?php echo $d["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In </button>
                            </div>
                        </div>
                    </div>
                    <!-- sign in -->
                    <div class="col-12 col-lg-6 d-none" id="signInBox">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="title2">Sign In To Your Account</p>
                                <p class="text-danger" id="msg2"></p>
                            </div>
                            <?php
                            $e = "";
                            $p = "";
                            if (isset($_COOKIE["e"])) {
                                $e = $_COOKIE["e"];
                            }
                            if (isset($_COOKIE["p"])) {
                                $p = $_COOKIE["p"];
                            }
                            ?>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="text" id="email2" value="<?php echo $e; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password2" value="<?php echo $p; ?>" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" value="1">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <a href="#" class="link-primary" onclick="forogotPassword();">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to eShop? Join Now</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- image and fields -->



        </div>

    </div>

    <!-- footer -->
    <div class="col-12 d-none d-lg-block fixed-bottom">
        <p class="text-center foot_title">&copy; 2021 eshop.lk All Right Reserved</p>
    </div>
    <!-- footer -->

    <!-- modal -->
    <div class="modal fade" tabindex="-1" id="forgetPasswordModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Password Reset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">New Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="password" id="np" />
                                <button class="btn btn-outline-primary" type="button" id="npb" onclick="showPassword1();">Show</button>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Re-type Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="password" id="rnp" />
                                <button class="btn btn-outline-primary" type="button" id="rnpb" onclick="showPassword2();">Show</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Verification Code</label>
                            <input class="form-control" type="text" id="vc" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->


    <script src="bootstrap.js"></script>
    <script src="script.js"></script>

</body>

</html>