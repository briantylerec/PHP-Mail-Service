<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";
$mail = new PHPMailer;
$mail->isSMTP();
//$mail->SMTPDebug = 2;

$request = json_decode(file_get_contents("php://input"));

if(!empty($request)){

  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls'; //seguridad
  $mail->Host = "smtp.gmail.com"; // servidor smtp
  $mail->Port = 587; //puerto
  $mail->Username = $request->mailOrigen; //nombre usuario
  $mail->Password = $request->pass; //contraseña
  error_log(print_r($request->mailOrigen,true));

  $mail->setFrom($request->mailOrigen, $request->name);
  $mail->AddAddress($request->mailOrigen);

  $mail->Subject = $request->subject;
  $mail->Body = "Nombre: " . ($request->name . " \n" . "Correo: " . $request->email . " \n" ."Teléfono: " . $request->telefono. " \n" ."Mensaje: " . $request->message);

  if ($mail->Send()) {
    echo json_encode(true);
    error_log(print_r("Mail enviado",true));
  }
  else{
    echo json_encode(false);
    error_log(print_r("Mail no enviado",true));
  }
  error_log(print_r("Con datos",true));
}else{
  error_log(print_r("No datos",true));
} 