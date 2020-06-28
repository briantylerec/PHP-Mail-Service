<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";
$mail = new PHPMailer;
$mail->isSMTP();
//$mail->SMTPDebug = 2;

$postdata = file_get_contents("php://input");
error_log(print_r($postdata,true));

$request = json_decode($postdata);
error_log(print_r($request,true));

$mail->From = 'monksoftdev@gmail.com'; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username ='monksoftdev@gmail.com'; //nombre usuario
$mail->Password = 'Gbienvenidos5!!@2022'; //contraseña
//destinatario
$mail->AddAddress($_POST[$request->email]);
$mail->Subject = $_POST[$request->subject];
$mail->Body = $_POST[$request->message];
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado Correctamente");
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("NO ENVIADO, intentar de nuevo");
        </script>';
}