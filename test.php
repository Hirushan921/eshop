<!-- updateprofileprocess.php -->

<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line1 = $_POST["a1"];
    $line2 = $_POST["a2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $pcode = $_POST["pc"];



    if (empty($fname)) {
        echo "Please enter your first name";
    } elseif (strlen($fname) > 50) {
        echo "First name must be less than 50 characters";
    } elseif (empty($lname)) {
        echo "Please enter your last name";
    } elseif (strlen($lname) > 50) {
        echo "Last name must be less than 50 characters";
    } elseif (empty($mobile)) {
        echo  "Please enter your mobile";
    } elseif (strlen($mobile) != 10) {
        echo  "Please enter 10 digit mobile number";
    } elseif (preg_match("/07[0,1,2,,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo  "Invalid mobile number";
    } elseif (empty($line1)) {
        echo "Please enter your address line 01";
    } elseif (empty($line2)) {
        echo "Please enter your address line 02";
    } elseif ($province == "0") {
        echo "Please enter your province";
    } elseif ($district == "0") {
        echo "Please enter your district";
    } elseif (empty($city)) {
        echo "Please enter your city";
    } elseif (empty($pcode)) {
        echo "Please enter postal code";
    } else {
        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $email . "'");


        $avilableaddress = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");
        $avadrow = $avilableaddress->num_rows;

        if ($avadrow == 1) {
            // update
            $ucitysearch = Database::search("SELECT * FROM `city` WHERE `name`='" . $city . "' AND `postal_code`='" . $pcode . "' AND `district_id`='" . $district . "' ");

            $ucityrow = $ucitysearch->num_rows;

            $upd_city_id;

            if ($ucityrow == 1) {
                $ucityresult = $ucitysearch->fetch_assoc();
                $upd_city_id = $ucityresult["id"];
            } else {
                Database::iud("INSERT INTO `city`(`name`,`postal_code`,`district_id`) VALUES('" . $city . "','" . $pcode . "','" . $district . "')");
                $upd_city_id = Database::$connection->insert_id;
            }

            Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "',`line2`='" . $line2 . "',`city_id`='" . $upd_city_id . "' WHERE `user_email`='" . $email . "'");
        } else {
            // insert
            $citysearch = Database::search("SELECT * FROM `city` WHERE `name`='" . $city . "' AND `postal_code`='" . $pcode . "' AND `district_id`='" . $district . "' ");

            $cityrow = $citysearch->num_rows;

            $ins_city_id;

            if ($cityrow == 1) {
                $cityresult = $citysearch->fetch_assoc();
                $ins_city_id = $cityresult["id"];
            } else {
                Database::iud("INSERT INTO `city`(`name`,`postal_code`,`district_id`) VALUES('" . $city . "','" . $pcode . "','" . $district . "')");
                $ins_city_id = Database::$connection->insert_id;
            }

            Database::iud("INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`city_id`) VALUES('" . $email . "','" . $line1 . "','" . $line2 . "','" . $ins_city_id . "')");
        }

        echo "Updated Success";
    }
}
?>
<!-- updateprofileprocess.php -->
















<!-- searchToUpdateProcess.php -->

<?php
require "connection.php";
$id = $_GET["id"];
// echo $id;


$array;

if (isset($_GET["id"])) {
    $id = $_GET["id"];


    if (empty($id)) {
        echo "Please enter the product id";
    } else {
        $prs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
        $n = $prs->num_rows;

        if ($n == 1) {
            $r = $prs->fetch_assoc();

            $array["id"] = $r["id"];
            $array["title"] = $r["title"];

            $crs = Database::search("SELECT * FROM `Category` WHERE `id`='" . $r["category_id"] . "'");

            if ($crs->num_rows == 1) {
                $cr = $crs->fetch_assoc();
                $array["category"] = $cr["name"];
            }

            echo json_encode($array);
        } else {
            echo "Invalid Product";
        }
    }
}

?>
<!-- searchToUpdateProcess.php -->









<!-- filterprocess -->
<?php
require "connection.php";
session_start();

$user = $_SESSION["u"];

$aray;

$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

if (!empty($search)) {
    $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%'");
    $pn = $products->num_rows;


    for ($x = 0; $x < $pn; $x++) {

        $aray[$x] = $products->fetch_assoc();



        // $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_id."'");

        // if($productimg->num_rows==1){
        //     $img = $productimg->fetch_assoc();

        //     $array['img']=$img["code"];
        // }


    }
    echo json_encode($aray);
}
?>






function addFilters() {
var search = document.getElementById("s");

var age;
if (document.getElementById("n").checked) {
age = 1;
} else if (document.getElementById("o").checked) {
age = 2;
} else {
age = 0;
}

var qty;
if (document.getElementById("l").checked) {
qty = 1;
} else if (document.getElementById("h").checked) {
qty = 2;
} else {
qty = 0;
}

var condition;
if (document.getElementById("b").checked) {
condition = 1;
} else if (document.getElementById("u").checked) {
condition = 2;
} else {
condition = 0;
}

var f = new FormData();
f.append("s", search.value);
f.append("a", age);
f.append("q", qty);
f.append("c", condition);

var r = new XMLHttpRequest();
r.onreadystatechange = function() {
if (r.readyState == 4) {
var t = r.responseText;

var arr = JSON.parse(t);
for (var i = 0; i < arr.length; i++) { var row=arr[i]; alert(row["title"]); } } }; r.open("POST", "filterProcess.php" , true); r.send(f); } <!-- filterprocess -->







    <!-- basic search  -->
    <?php

    require "connection.php";

    $searchText = $_GET["t"];
    $searchSelect = $_GET["s"];

    // echo $searchText;
    // echo $searchSelect;
    $aray;

    if (!empty($searchText) && $searchSelect == 0) {

        $textsearch = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%'");
        $n = $textsearch->num_rows;

        if ($n >= 1) {
            for ($i = 0; $i < $n; $i++) {
                $row = $textsearch->fetch_assoc();

                $img = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $row["id"] . "'");
                $n1 = $img->num_rows;
                if ($n1 >= 1) {
                    $row1 = $img->fetch_assoc();
                    $row["img"] = $row1["code"];
                }
                $aray[$i] = $row;
            }
            echo json_encode($aray);
        }
    } else if ($searchSelect != 0 && empty($searchText)) {
    } elseif (!empty($searchText) && $searchSelect != 0) {
    } else {
    }

    ?>




    function basicSearch() {
    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    // alert(searchText);
    // alert(searchSelect);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
    if (r.readyState == 4) {
    var text = r.responseText;
    // alert(text);
    var ar = JSON.parse(text);
    alert(ar);

    for (var i = 0; i < ar.length; i++) { var div=document.createElement("div"); div.className="card col-6 col-lg-2  mt-1 mb-1 ms-1" ; var img=document.createElement("img"); img.className="cardtopimg" ; // img.src="resources/mobile images/" + ar[i]["img"]; img.src=ar[i]["img"]; var div1=document.createElement("div"); div1.className="card-body" ; var h5=document.createElement("h5"); h5.className="card-title" ; h5.innerHTML=ar[i]["title"]; var span1=document.createElement("span"); span1.innerHTML=" New" ; span1.className="ms-2 badge bg-info" ; var span2=document.createElement("span"); span2.className="card-text text-primary" ; span2.innerHTML=ar[i]["price"]; var br=document.createElement("br"); var span3=document.createElement("span"); span3.className="card-text text-warning" ; span3.innerHTML="In Stock" ; var input=document.createElement("input"); input.type="number" ; input.value=ar[i]["qty"]; input.className="form-control mb-1" ; var a1=document.createElement("a"); a1.className="btn btn-success col-12" ; a1.innerHTML="Buy Now" var a2=document.createElement("a"); a2.className="btn btn-danger col-12" ; a2.innerHTML="Add To Cart" ; div.appendChild(div1); div.appendChild(img); div1.appendChild(h5); h5.appendChild(span1); div1.appendChild(span2); div1.appendChild(br); div1.appendChild(span3); div1.appendChild(input); div1.appendChild(a1); div1.appendChild(a2); // document.getElementById("pcat").className="d-none" ; document.getElementById("pdetails").appendChild(div); } } }; r.open("GET", "basicSearchProcess.php?t=" + searchText + "&s=" + searchSelect, true); r.send(); } <!-- basic search -->





        <div class="card col-6 mb-3 mt-3">
            <div class="row g-0">
                <div class="col-md-4 mt-4">
                    <?php
                    $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productrow["id"] . "'");
                    $in = $imgrs->num_rows;

                    for ($z = 0; $z < $in; $z++) {
                        $ir = $imgrs->fetch_assoc();
                    ?>
                        <img src="<?php echo $ir["code"]; ?>" class="img-fluid rounded-start" />
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $productrow["title"]; ?></h5>
                        <span class="card-text fw-bold text-primary">Rs. <?php echo $productrow["price"]; ?>.00</span>
                        <br />
                        <span class="card-text fw-bold text-success"><?php echo $productrow["qty"]; ?>Items Left</span>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-8 offset-lg-2 mt-1">
                                    <a href="#" class="btn btn-success d-grid">Buy Now</a>
                                </div>
                                <div class="col-12 col-lg-8 offset-lg-2 mt-1 ">
                                    <a href="#" class="btn btn-danger d-grid">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>