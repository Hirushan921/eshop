<?php
require "connection.php";

$product = $_GET["p"];

$statusrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product . "'");
$sn = $statusrs->num_rows;

if ($sn == 1) {
    $sd = $statusrs->fetch_assoc();
    $status_id = $sd["status_id"];

    if ($status_id == 1) {
        Database::iud("UPDATE `product` SET `status_id`=2 WHERE `id`='" . $product . "'");
        echo "deactive";
    } elseif ($status_id == 2) {
        Database::iud("UPDATE `product` SET `status_id`=1 WHERE `id`='" . $product . "'");
        echo "active";
    }
    // echo "success";
} else {
    echo "Error";
}

?>
