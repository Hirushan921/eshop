<?php

require "connection.php";
session_start();

$title = $_POST["t"];
$qty = (int)$_POST["qty"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["desc"];

// echo $title;
// echo "<br/>";
// echo $qty;
// echo "<br/>";
// echo $dwc;
// echo "<br/>";
// echo $doc;
// echo "<br/>";
// echo $description;


$pid = $_SESSION["p"]["id"];

if (empty($title)) {
    echo "Please Add a Title";
} else if (strlen($title) > 100) {
    echo "Title must contain 100 or more than 100 characters";
} else if ($qty == "0" || $qty == "e") {
    echo "Please Add the Quantity Of Your Product.";
} else if (!is_int($qty)) {
    echo "Please Add valid Quantity.";
} else if (empty($qty)) {
    echo "Please Add Quantity of your Product.";
} else if ($qty < 0) {
    echo "Please Add a Valid Quantity.";
} else if (empty($dwc)) {
    echo "Please Insert Delivery cost inside Colombo District.";
} else if (!is_int($dwc)) {
    echo "Please Insert a Valid Price.";
} else if (empty($doc)) {
    echo "Please Insert Delivery cost outside Colombo District.";
} else if (!is_int($doc)) {
    echo "Please Insert a Valid Price.";
} else if (empty($description)) {
    echo "Please Enter the Description of Your Product.";
} else {

    Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`description`='" . $description . "',`delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "' WHERE `id`='" . $pid . "' ");

    echo "Updated Success";

    $imgsearch = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
    $in = $imgsearch->num_rows;

    if ($in >= 1) {
        // update 

        if (isset($_FILES["img"])) {
            $imageFile = $_FILES["img"];
            $fileNewName = $_FILES["img"]["name"];

            $allowed_image_extension = array("jpg", "png", "svg");  // Allow karana img files
            $file_extension = pathinfo($fileNewName, PATHINFO_EXTENSION);  // img eke extension

            // echo $file_extension = $image["type"];

            if (!in_array($file_extension, $allowed_image_extension)) {
                echo "Please Select a Valid Image";
            } else {
                // echo $imageFile["name"];
                $fileName = "resources/products//" . uniqid() . "." . $file_extension;
                move_uploaded_file($imageFile["tmp_name"], $fileName);

                Database::iud("UPDATE `images` SET `code`='" . $fileName . "' WHERE `product_id`='" . $pid . "'");
            }
        }
    } else {
        // insert

        if (isset($_FILES["img"])) {
            $imageFile = $_FILES["img"];
            $fileNewName = $_FILES["img"]["name"];

            $allowed_image_extension = array("jpg", "png", "svg");  // Allow karana img files
            $file_extension = pathinfo($fileNewName, PATHINFO_EXTENSION);  // img eke extension

            // echo $file_extension = $image["type"];

            if (!in_array($file_extension, $allowed_image_extension)) {
                echo "Please Select a Valid Image";
            } else {
                // echo $imageFile["name"];
                $fileName = "resources/products//" . uniqid() . "." . $file_extension;
                move_uploaded_file($imageFile["tmp_name"], $fileName);

                Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES('" . $fileName . "','" . $pid . "')");
            }
        } else {
            echo "Please Select an Image";
        }
    }

    $product = Database::search("SELECT * FROM `Product` WHERE `id`='" . $pid . "'");
    $n = $product->num_rows;

    if ($n == 1) {
        $row = $product->fetch_assoc();
        $_SESSION["p"] = $row;
    }
}
