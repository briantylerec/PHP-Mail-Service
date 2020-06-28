<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";
$mail = new PHPMailer;
$mail->isSMTP();
//$mail->SMTPDebug = 2;

$postdata = file_get_contents("php://input");
error_log(print_r($postdata,true));

$request = json_decode($postdata);
error_log(print_r($request,true));

$mail->setFrom($request->email, $request->name); //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username = $request->mailOrigen; //nombre usuario
$mail->Password = $request->pass; //contraseña
//destinatario
$mail->AddAddress($request->mailOrigen);
$mail->Subject = $request->subject;
$mail->Body = $request->name + ' escribió: ' + $request->message;
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
  echo json_encode(true);
}
else{
  echo json_encode(false);
}