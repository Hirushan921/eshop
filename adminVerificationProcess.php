<?php
require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){
    $email = $_POST["e"];

if(empty($email)){
    echo "Please enter your email address.";
}else{
    $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $an = $adminrs->num_rows;
    
    if($an==1){
        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'himashahiru921@gmail.com';
        $mail->Password = 'herathtripleh0318';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('himashahiru921@gmail.com', 'eshop');
        $mail->addReplyTo('himashahiru921@gmail.com', 'eshop');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop admin verification code';
        $bodyContent = '<h1>Your verification code is '.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'success';
        }


    }else{
        echo "You are not a valid user.";
    }
}




}else{
    echo "Please enter your email address.";
}

?>