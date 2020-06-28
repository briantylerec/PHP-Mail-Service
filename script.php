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

$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username = $request->mailOrigen; //nombre usuario
$mail->Password = $request->pass; //contraseña

$mail->setFrom($request->mailOrigen, $request->name);
$mail->AddAddress($request->mailOrigen);

$mail->Subject = $request->subject;
$mail->Body = "Nombre: " . ($request->name . " \n" . "Correo: " . $request->email . " \n" ."Mensaje: " . $request->message);

if ($mail->Send()) {
  echo json_encode(true);
}
else{
  echo json_encode(false);
}