<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../modelos/PHPMailer-master/src/Exception.php';
require '../modelos/PHPMailer-master/src/PHPMailer.php';
require '../modelos/PHPMailer-master/src/SMTP.php';

/**
 * Obtenemos los datos del estudiante para notificarle de su alta en el sistema
 */
$nombre = htmlentities($_POST['n']);
$paterno = htmlentities($_POST['p']);
$correo = htmlentities($_POST['co']);
$usuario = htmlentities($_POST['u']);
$contraseña = htmlentities($_POST['con']);

// Notificamos por correo al profesor sobre la baja
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sistanalisoci@gmail.com';                     //SMTP username
    $mail->Password   = 'dvkbdyfxnowrwkvq';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sistanalisoci@gmail.com', 'SAS');
    $mail->addAddress($correo, "{$nombre} {$paterno}");     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Notificación de registro.';
    $mail->Body    = "<h1>Estimado {$nombre} {$paterno}:\r\nEste correo es para notificarte que se te ha dado de alta en SAS.</h1> <br> 
                        <p>Tus credenciales para ingresar al sistema son: <br>
                            usuario: <strong>{$usuario}</strong> <br>
                            contraseña: <strong>{$contraseña}</strong>
                        </p>";
    $mail->AltBody = "Estimado {$nombreProfesor}:\r\nSe te notifica que el alumno {$nombreAlumno} se ha dado de baja de tu clase {$nombreClase}.";

    $mail->CharSet = 'UTF-8';
    $mail->send();
} catch (Exception $e) {
}
