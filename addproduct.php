<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>eShop | Add Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">




            <div id="addproductbox">
                <!-- header -->
                <div class="col-12 mb-4">
                    <h3 class="h2 text-center text-primary">Product Listing</h3>
                </div>
                <!-- header -->

                <!-- category brand model -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Category</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="ca">
                                        <option value="0">Select Category</option>
                                        <?php
                                        $cat = Database::search("SELECT * FROM `category`");
                                        $n = $cat->num_rows;
                                        for ($X = 0; $X < $n; $X++) {
                                            $c = $cat->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $c["id"];?>"><?php echo $c["name"];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Brand</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="br">
                                        <option value="0">Select Brand</option>
                                        <?php
                                        $br = Database::search("SELECT * FROM `brand`");
                                        $n = $br->num_rows;
                                        for ($X = 0; $X < $n; $X++) {
                                            $b = $br->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $b["id"];?>"><?php echo $b["name"];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Model</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="mo">
                                        <option value="0">Select Model</option>
                                        <?php
                                        $mo = Database::search("SELECT * FROM `model`");
                                        $n = $mo->num_rows;
                                        for ($X = 0; $X < $n; $X++) {
                                            $m = $mo->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $m["id"];?>"><?php echo $m["name"];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- category brand model -->

                <hr class="hrbreak1" />

                <!-- title -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add a Title to your Product</label>
                        </div>
                        <div class="offset-lg-2 col-lg-8 col-12 ">
                            <input class="form-control" type="text" id="ti" />
                        </div>
                    </div>
                </div>
                <!-- title -->

                <hr class="hrbreak1" />

                <!-- condition,color,qty -->
                <div class="col-12">
                    <div class="row">

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Condition</label>
                                </div>
                                <div class="form-check offset-lg-1 offset-1 col-5 col-lg-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked>
                                    <label class="form-check-label" for="bn">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="form-check offset-lg-1 offset-1 col-5 col-lg-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="us">
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Colour</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked>
                                            <label class="form-check-label" for="clr1">
                                                Gold
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr2">
                                            <label class="form-check-label" for="clr2">
                                                Silver
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr3">
                                            <label class="form-check-label" for="clr3">
                                                Graphite
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr4">
                                            <label class="form-check-label" for="clr4">
                                                Pacific Blue
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr5">
                                            <label class="form-check-label" for="clr5">
                                                Jet Black
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr6">
                                            <label class="form-check-label" for="clr6">
                                                Rose Black
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Quantity</label>
                                    <input class="form-control" type="number" value="0" min="0" id="qty" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- condition,color,qty -->

                <hr class="hrbreak1" />

                <!-- cost,payment method -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Cost Per Item</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 col-lg-11 offset-lg-1">
                                    <label class="form-label lbl1">Approved Payment Methods</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-2 col-2 pm1"></div>
                                        <div class="col-2 pm2"></div>
                                        <div class="col-2 pm3"></div>
                                        <div class="col-2 pm4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cost,payment method -->

                <hr class="hrbreak1" />

                <!-- delivery cost -->
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Delivery Cost</label>
                            </div>
                            <div class="offset-lg-1 col-12 col-lg-3">
                                <label class="form-label">Delivery Cost Within Colombo</label>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1"></label>
                            </div>
                            <div class="offset-lg-1 col-12 col-lg-3 mt-3">
                                <label class="form-label">Delivery Cost out of Colombo</label>
                            </div>
                            <div class="col-12 col-lg-7 mt-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- delivery cost -->

                <hr class="hrbreak1" />

                <!-- description -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Product Description</label>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" cols="100" rows="30" style="background-color: honeydew;" id="desc"></textarea>
                        </div>
                    </div>
                </div>
                <!-- description -->

                <hr class="hrbreak1" />

                <!-- product image  -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add Product Image</label>
                        </div>
                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail" id="prev" />
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 ms-lg-1 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                            <label class="btn btn-primary col-5 col-lg-8" for="imguploader" onclick="changeImage();">Upload</label>
                                        </div>
                                        <!-- <div class="col-6 col-lg-4 d-grid mt-2 mt-lg-0">
                                        <button class="btn btn-primary">Upload</button>
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product image  -->

                <hr class="hrbreak1" />

                <!-- notice -->
                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                    <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>
                </div>
                <!-- notice -->

                <!-- save btn  -->
                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid">
                    <button class="btn btn-success searchbtn" onclick="addProduct();">Add Product</button>
                </div>
                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mt-3 mt-lg-4 mb-4">
                    <button class="btn btn-dark searchbtn" onclick="changeProductView();">Update Product</button>
                </div>
                <!-- save btn  -->


                <!-- footer -->
                <?php
                require "footer.php";
                ?>
                <!-- footer -->
            </div>








            <div id="updateproductbox" class="d-none">
                <!-- header -->
                <div class="col-12 mb-2">
                    <h3 class="h2 text-center text-primary">Product Update</h3>
                </div>
                <!-- header -->

                <!-- search field  -->
                <div class="col-12 mb-3 mt-5">
                    <div class="row">
                        <div class="offset-o offset-lg-1 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="Search Product You Want To Update" />
                        </div>
                        <div class="col-12 col-lg-4 d-grid">
                            <button class="btn btn-primary mt-2 mt-lg-0">Search Product</button>
                        </div>
                    </div>
                </div>
                <!-- search field  -->

                <hr class="hrbreak1" />

                <!-- category brand model -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Category</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="ca" disabled>
                                        <option value="0">Select Category</option>
                                        <option value="1">Cell Phones & Accessories</option>
                                        <option value="2">Computers & Tablets</option>
                                        <option value="3">Cameras</option>
                                        <option value="4">Camera Drones</option>
                                        <option value="5">Video Game Consoles</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Brand</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="br" disabled>
                                        <option value="0">Select Brand</option>
                                        <option value="1">Samsung</option>
                                        <option value="2">Apple</option>
                                        <option value="3">Oppo</option>
                                        <option value="4">##</option>
                                        <option value="5">Video Game Consoles</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Model</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="mo" disabled>
                                        <option value="0">Select Model</option>
                                        <option value="1">aaa</option>
                                        <option value="2">##</option>
                                        <option value="3">Cameras</option>
                                        <option value="4">Camera Drones</option>
                                        <option value="5">Video Game & Consoles</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- category brand model -->

                <hr class="hrbreak1" />

                <!-- title -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add a Title to your Product</label>
                        </div>
                        <div class="offset-lg-2 col-lg-8 col-12 ">
                            <input class="form-control" type="text" id="ti" />
                        </div>
                    </div>
                </div>
                <!-- title -->

                <hr class="hrbreak1" />

                <!-- condition,color,qty -->
                <div class="col-12">
                    <div class="row">

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Condition</label>
                                </div>
                                <div class="form-check offset-lg-1 offset-1 col-5 col-lg-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" disabled>
                                    <label class="form-check-label" for="bn">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="form-check offset-lg-1 offset-1 col-5 col-lg-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" disabled>
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Colour</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr1" disabled>
                                            <label class="form-check-label" for="clr1">
                                                Gold
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr2" disabled>
                                            <label class="form-check-label" for="clr2">
                                                Silver
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr3" disabled>
                                            <label class="form-check-label" for="clr3">
                                                Graphite
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr4" disabled>
                                            <label class="form-check-label" for="clr4">
                                                Pacific Blue
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr5" disabled>
                                            <label class="form-check-label" for="clr5">
                                                Jet Black
                                            </label>
                                        </div>
                                        <div class="form-check col-lg-4 offset-lg-0 col-5 offset-1">
                                            <input class="form-check-input" type="radio" name="clrradio" id="clr6" disabled>
                                            <label class="form-check-label" for="clr6">
                                                Rose Black
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Quantity</label>
                                    <input class="form-control" type="number" value="0" min="0" id="qty" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- condition,color,qty -->

                <hr class="hrbreak1" />

                <!-- cost,payment method -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Cost Per Item</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" disabled>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 col-lg-11 offset-lg-1">
                                    <label class="form-label lbl1">Approved Payment Methods</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-2 col-2 pm1"></div>
                                        <div class="col-2 pm2"></div>
                                        <div class="col-2 pm3"></div>
                                        <div class="col-2 pm4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cost,payment method -->

                <hr class="hrbreak1" />

                <!-- delivery cost -->
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Delivery Cost</label>
                            </div>
                            <div class="offset-lg-1 col-12 col-lg-3">
                                <label class="form-label">Delivery Cost Within Colombo</label>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1"></label>
                            </div>
                            <div class="offset-lg-1 col-12 col-lg-3 mt-3">
                                <label class="form-label">Delivery Cost out of Colombo</label>
                            </div>
                            <div class="col-12 col-lg-7 mt-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- delivery cost -->

                <hr class="hrbreak1" />

                <!-- description -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Product Description</label>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" cols="100" rows="30" style="background-color: honeydew;" id="desc"></textarea>
                        </div>
                    </div>
                </div>
                <!-- description -->

                <hr class="hrbreak1" />

                <!-- product image  -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add Product Image</label>
                        </div>
                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail" id="prev" />
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 ms-lg-1 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                            <label class="btn btn-primary col-5 col-lg-8" for="imguploader" onclick="changeImage();">Upload</label>
                                        </div>
                                        <!-- <div class="col-6 col-lg-4 d-grid mt-2 mt-lg-0">
                                        <button class="btn btn-primary">Upload</button>
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product image  -->

                <hr class="hrbreak1" />

                <!-- notice -->
                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                    <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>
                </div>
                <!-- notice -->

                <!-- save btn  -->
                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid">
                    <button class="btn btn-success searchbtn">Update Product</button>
                </div>
                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mt-3 mt-lg-4 mb-4">
                    <button class="btn btn-dark searchbtn" onclick="changeProductView();">Add Product</button>
                </div>
                <!-- save btn  -->


                <!-- footer -->
                <?php
                require "footer.php";
                ?>
                <!-- footer -->
            </div>







        </div>
    </div>



    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>