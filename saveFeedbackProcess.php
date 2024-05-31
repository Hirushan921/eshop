<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $mail = $_SESSION["u"]["email"];

    $id = $_POST["i"];
    $txt = $_POST["ft"];

    $d = new DateTime();
    $tz = new DateTimeZone("ASia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`user_email`,`product_id`,`feed`,`date`) VALUES('" . $mail . "','" . $id . "','" . $txt . "','" . $date . "')");

    echo "1";
}
