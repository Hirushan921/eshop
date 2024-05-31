<?php
session_start();

$e = $_POST["email"];
$p = $_POST["password"];
$r = $_POST["remember"];



require "connection.php";

$rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' AND `password`='" . $p . "'");
$n = $rs->num_rows;

if ($n == 1) {
   echo "success";
   $d = $rs->fetch_assoc();
   $_SESSION["u"] = $d;

   if($r=="true"){
       setcookie("e",$e,time()+(60*60*24*365));
       setcookie("p",$p,time()+(60*60*24*365));
   }else{
       setcookie("e","",-1);
       setcookie("p","",-1);
   }

} else {
   echo "Invalid Details"; 
}
