<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="col-12">
        <div class="row mt-1">
            <div class="col-12 offset-lg-1 col-lg-4 align-self-start">
                <span class="text-start label1"><b>Welcome</b>
                    <?php
                    if (isset($_SESSION["u"])) {
                        $username = $_SESSION["u"]["fname"];
                        echo $username;
                        ?>
                        | <span class="text-start label2" onclick="signout();">Sign Out</span>
                        <?php
                    } else {
                    ?>
                        <a href="index.php">Hi! Sign in or register</a>
                    <?php
                    }

                    ?>
                </span> |
                <span class="text-start label2">Help and Contact</span> 
            </div>
            <div class="offset-lg-4 col-12 col-lg-3 align-self-end" style="text-align: center;">
                <div class="row  mb-1 mt-lg-0 mt-1">
                    <div class="col-1 col-lg-2 mt-1">
                        <span class="text-start label2" onclick="goToAddProduct();">Sell</span>
                    </div>
                    <div class="dropdown col-2 col-lg-6">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                            <li><a class="dropdown-item" href="purchasehistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="messages.php?email=<?php echo $_SESSION["u"]["email"]; ?>">Message</a></li>
                            <li><a class="dropdown-item" href="sellerproductview.php">My Products</a></li>
                            <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Sellings</a></li>
                        </ul>
                    </div>
                    <div class="col-1 col-lg-2 mt-1 ms-5 ms-lg-1 carticon" style="cursor: pointer;" onclick="goToCart();"></div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>