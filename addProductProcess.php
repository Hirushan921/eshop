<?php

require "connection.php";
session_start();

$category = (int)$_POST["c"];
$brand = $_POST["b"];
$model= $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$colour = $_POST["col"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["desc"];

// echo $category;
// echo "<br/>";
// echo $brand;
// echo "<br/>";
// echo $model;
// echo "<br/>";
// echo $title;
// echo "<br/>";
// echo $condition;
// echo "<br/>";
// echo $colour;
// echo "<br/>";
// echo $qty;
// echo "<br/>";
// echo $price;
// echo "<br/>";
// echo $dwc;
// echo "<br/>";
// echo $doc;
// echo "<br/>";
// echo $description;


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;
$useremail =$_SESSION["u"]["email"];

if($category=="0"){
    echo "Please Select a Category.";
}else if($brand=="0"){
    echo "Please Select a Brand.";
}else if($model=="0"){
    echo "Please Select a Model.";
}else if(empty($title)){
    echo "Please Add a Title";
}else if(strlen($title)>100){
    echo "Title must contain 100 or more than 100 characters";
}else if($qty=="0" || $qty =="e"){
    echo "Please Add the Quantity Of Your Product.";
}else if(!is_int($qty)){
    echo "Please Add valid Quantity.";
}else if(empty($qty)){
    echo "Please Add Quantity of your Product.";
}else if($qty < 0){
    echo "Please Add a Valid Quantity.";
}else if(empty($price)){
    echo "Please Add the Price of Your Product.";
}else if(!is_int($price)){
    echo "Please Insert a Valid Price.";
}else if(empty($dwc)){
    echo "Please Insert Delivery cost inside Colombo District.";
}else if(!is_int($dwc)){
    echo "Please Insert a Valid Price.";
}else if(empty($doc)){
    echo "Please Insert Delivery cost outside Colombo District.";
}else if(!is_int($doc)){
    echo "Please Insert a Valid Price.";
}else if(empty($description)){
    echo "Please Enter the Decription of Your Product.";
}else{
    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "'");

    if ($modelHasBrand->num_rows == 0) {
        echo "This Product Doesn't Exists";
    } else {
        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandId = $f["id"];

        // echo $modelHasBrandId;

        Database::iud("INSERT INTO `product` 
        (`category_id`,`model_has_brand_id`,`title`,`color_id`,`price`,`qty`,`description`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`)
        VALUES
        ('".$category."','".$modelHasBrandId."','".$title."','".$colour."','".$price."','".$qty."','".$description."','".$condition."','".$state."','".$useremail."','".$date."','".$dwc."','".$doc."');");
    
        echo "Product Upload success";

        $last_id = Database::$connection->insert_id; // anthimeta add karapu product eke id eka

    
        if(isset($_FILES["img"])){
            $imageFile = $_FILES["img"];
            $fileNewName = $_FILES["img"]["name"];

            $allowed_image_extension = array("jpg","png","svg");  // Allow karana img files
            $file_extension = pathinfo($fileNewName, PATHINFO_EXTENSION);  // img eke extension

            // echo $file_extension = $image["type"];
    
            if(!in_array($file_extension, $allowed_image_extension)){
                echo "Please Select a Valid Image";
            }else{
                // echo $imageFile["name"];
                $fileName = "resources/products//".uniqid().".".$file_extension;
                move_uploaded_file($imageFile["tmp_name"],$fileName);
    
                Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES('".$fileName."','".$last_id."')");
            }

        }else{
            echo "Product Upload success & No Image Uploaded!";
        }

    }
}


?>