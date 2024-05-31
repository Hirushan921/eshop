<?php
require "connection.php";

$prid = $_GET["id"];

$productd = Database::search("SELECT * FROM `product` WHERE `id`='".$prid."'");
$pnum=$productd->num_rows;

if($pnum==1){
    Database::iud("DELETE FROM `images` WHERE `product_id`='".$prid."'");
    Database::iud("DELETE FROM `product` WHERE `id`='".$prid."'");

    echo "Product Deleted";
}else{
    echo "Product does not exists";
}


?>