<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../modelos/PHPMailer-master/src/Exception.php';
require '../modelos/PHPMailer-master/src/PHPMailer.php';
require '../modelos/PHPMailer-master/src/SMTP.php';

include '../modelos/Inscripcion.php';
include '../modelos/Estudiante.php';
include '../modelos/Clase.php';

/**
 * Obtenemos el id de la clase y del alumno del registro de inscripción.
 */
$idUsuario = htmlentities($_GET['ia']);
$idClase = htmlentities($_GET['ic']);

$inscripcion = new Inscripcion();

/**
 * Llamamos al método que ejecuta la actualización en la base de datos.
 */
$estadoActualizado = $inscripcion->setEstado($idClase, $idUsuario);

/**
 * Verificamos que la actualización se haya realizado correctamente.
 */
if ($estadoActualizado) {
    echo "<script> alert('La solicitud de baja se ha aceptado correctamente.'); </script>";

    /**
     * Obtenemos el nombre del estudiante.
     */
    $estudiante = new Estudiante($idUsuario);
    $nombreEstudiante = $estudiante->getNombre(true)[0];
    $correoEstudiante = $estudiante->getCorreo(true)[0];

    /**
     * Obtenemos el nombre de la clase.
     */
    $clase = new Clase(null, $idClase);
    $clase->getDatos(true);
    $clase = $clase->getNombre();

    /**
     * Notificamos al alumno por correo electrónico que su petición ha sido aceptado por el profesor.
     */
    // Notificamos por correo al profesor sobre la baja
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sistanalisoci@gmail.com';                     //SMTP username
        $mail->Password   = 'ufkemmqdikeqggvs';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sistanalisoci@gmail.com', 'SAS');
        $mail->addAddress($correoEstudiante, $estudiante);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Notificación de baja aceptada.';

        $mail->Body    = "<html lang='es'><body>";
        $mail->Body   .= "<h1>Estimado {$nombreEstudiante}: Se te notifica que tu profesor ha aceptado tu petición de baja de tu clase {$clase}.</h1>";
        $mail->Body   .= "</body></html>";

        $mail->AltBody = "Estimado {$nombreEstudiante}:\r\nSe te notifica que tu profesor ha aceptado tu petición de baja de tu clase {$clase}.";

        $mail->CharSet = 'UTF-8';
        if ($mail->send()) {
            echo "<script> alert('Hemos notificado al alumno sobre tu decisión.'); </script>";
            echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
        }
    } catch (Exception $e) {
        echo "<script> alert('Ocurrió un error: {$e->errorMessage()}.); </script>";
    }
} else {
    echo "<script> alert('Ocurrió un error al realizar la actualización de la información. Favor de reportar la falla.'); </script>";
}

die();
