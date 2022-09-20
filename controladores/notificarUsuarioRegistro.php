<?php

include '../modelos/Notificacion.php';

/**
 * Obtenemos los datos del estudiante para notificarle de su alta en el sistema
 */
$nombre = htmlentities($_POST['n']);
$paterno = htmlentities($_POST['p']);
$correo = htmlentities($_POST['co']);
$usuario = htmlentities($_POST['u']);
$contraseña = htmlentities($_POST['con']);

/**
 * Creamos una notificación para enviar el correo al nuevo usuario
 */
$notificacion = new Notificacion('Notificación de registro en SAS.');

/**
 * Enviamos la notificación
 */
echo json_encode($notificacion->usuarioRegistrado($correo, $nombre, $paterno, $usuario, $contraseña));

/**
 * // Notificamos por correo al profesor sobre la baja
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sistanalisoci@gmail.com';                     //SMTP username
    $mail->Password   = 'gordjzpiknhrzlto';                               //SMTP password wccgqmrzivkoshwo
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
    $mail->AltBody = "Se te dio de alta en SAS.";

    $mail->CharSet = 'UTF-8';
    $mail->send();
} catch (Exception $e) {
    return $e->errorMessage();
}
 */
