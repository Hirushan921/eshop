    <!DOCTYPE html>

    <html>

    <head>
        <title>eShop | Admin | Sign In</title>
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

        <div class="container-fluid vh-100 d-flex justify-content-center">
            <div class="row align-content-center">

                <div class="col-12">
                    <div class="row">
                        <div class=" col-12 logo"></div>
                        <div class="col-12">
                            <p class="text-center title1">Hi, Welcome To eShop Admins</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 p-5">
                    <div class="row">
                        <div class="col-6 d-none d-lg-block background"></div>
                        <div class="col-12 col-lg-6 d-block">
                            <div class="row g-3">
                                <div class="col-12">
                                    <p class="title2">Sign In To Your Account</p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="e" />
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary" onclick="adminverification();">Send verification code to log in</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-danger">Back to user's log in</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Admin Verification</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Enter the verification code you got by an email.</label>
                              <input type="text" class="form-control" id="v"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="verify();" >Verify</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->



                <div class="col-12 d-none d-lg-block fixed-bottom">
                    <p class="text-center foot_title">&copy;2021 eshop.lk All Right Reserved</p>
                </div>




            </div>
        </div>




        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>