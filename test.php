<?php
use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';

$mail = new PHPMailer;
$mail->isSMTP();
//$mail->SMTPDebug = 2;

$mail->From = "monksoftdev@gmail.com"; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username = "monksoftdev@gmail.com"; //nombre usuario
$mail->Password = "Gbienvenidos5!!@2022"; //contraseña
//destinatario
$mail->AddAddress('monksoftdev@gmail.com', 'Brian Mora');
$mail->Subject = 'mi asunto';
$mail->Body = 'mi mensaje';
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
  echo json_encode(true);
}
else{
  echo json_encode(false);
}