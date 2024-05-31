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

    // $img = $_FILES["i"]["name"];

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

        // $last_user_id = Database::$connection->insert_id;

        $imgs = Database::search("SELECT * FROM `Profile_img` WHERE `user_email`='" . $email . "'");
        $ir = $imgs->num_rows;
        if ($ir == 1) {
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
                    $fileName = "resources/profile_img//".uniqid().".".$file_extension;
                    move_uploaded_file($imageFile["tmp_name"],$fileName);
        
                    Database::iud("UPDATE `profile_img` SET `code`='".$fileName."' WHERE `user_email`='".$email."'");
                }
            }
        } else {
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
                    $fileName = "resources/profile_img//".uniqid().".".$file_extension;
                    move_uploaded_file($imageFile["tmp_name"],$fileName);
        
                    Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES('".$fileName."','".$email."')");
                }
            }
        }

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

        $result=Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
        $s=$result->fetch_assoc();
        $_SESSION["u"] = $s;
    }
}
