<?php

require_once'../connections/connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



require_once "../vendor/autoload.php";

$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "	smtp.sendgrid.net";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "apikey";
$mail->Password = "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";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 25;

$mail->From = "dashboardmanager1@gmail.com";
$mail->FromName = "Black Rose Dashboard";

$mail->addAddress($memberemail);

$mail->isHTML(true);

$mail->Subject = "Thanks for joining Black Rose!";
$mail->Body = "Thanks you for joining Black Rose! Here is your randomly generated password. Once you use it to sign in for the first time, you will be asked to change it to a password of your choice. Password:".$randompswd;
$mail->AltBody = "Passowrd:".$randompswd;

try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}catch (phpmailerException $e){
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
}
?>
