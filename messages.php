<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {

    $customer = $_SESSION["u"]["email"];
    $email = $_GET["email"];
    // echo $email;
?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>eShop | Message</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);" onload="refresher('<?php echo $email; ?>');">

        <div class="container-fluid">
            <div class="row">

                <?php require "header.php"; ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 py-5 px-4">
                    <div class="row rounded overflow-hidden shadow">

                        <div class="col-lg-5 col-12 px-0">
                            <div class="bg-white">

                                <div class="bg-light px-4 py-2">
                                    <h5 class="mb-0 py-1">Recent</h5>
                                </div>
                                
                                <div class="messages-box">
                                    <div class="list-group rounded-0" id="rcv">

                                        
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-7 col-12 px-0">
                            <div class="row px-4 py-5 text-white chatbox" id="chatrow">
                                <!-- senders msg  -->

                                <!-- senders msg  -->

                                <!-- receivers msg  -->

                                <!-- receivers msg  -->
                            </div>
                        </div>

                       
                        <div class="col-12 col-lg-7 offset-lg-5">
                            <div class="row ">

                                <!-- text  -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="input-group">
                                        <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                            <div class="input-group-append">
                                                <button id="button-addon2" class="btn btn-link fs-1 bg-white" onclick="sendmessage('<?php echo $email; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- text  -->

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