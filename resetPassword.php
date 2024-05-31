<?php
require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if (empty($e)) {
    echo "Missing email address";
} elseif (empty($np)) {
    echo  "Please enter your new password";
} elseif (strlen($np) < 5 || strlen($np) > 20) {
    echo  "Password length must between 5 to 20";
} elseif (empty($rnp)) {
    echo  "Please Re enter your password";
} elseif ($np != $rnp) {
    echo "Password and Re-type Password does not match";
} elseif (empty($vc)) {
    echo "Please enter your verification code";
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' AND `verification_code`='" . $vc . "'");

    if ($rs->num_rows == 1) {
        Database::iud("UPDATE `user` SET `password`='" . $np . "' WHERE `email`='" . $e . "'");
        echo "success";
    } else {
        echo "Password reset fail!";
    }
}
