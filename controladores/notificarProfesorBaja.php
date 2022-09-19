<?php

include '../modelos/Estudiante.php';
include '../modelos/Profesor.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../modelos/PHPMailer-master/src/Exception.php';
require '../modelos/PHPMailer-master/src/PHPMailer.php';
require '../modelos/PHPMailer-master/src/SMTP.php';

// Iniciamos $_SESSION para obtener el id del alumno
session_start();

/* --------------------------- Obtenemos el nombre del estudiante que se dio de baja --------------------------- */
$alumno = new Estudiante($_SESSION['i']);
$datosAlumno = $alumno->getNombre();

if (!$datosAlumno) {
    echo json_encode('ERROR_GET_DATA_ALUMNO');
}

$nombreAlumno = $datosAlumno[0]; // Se obtiene el nombre del alumno

/* --------------------------- Obtenemos el id, nombre y correo del profesor --------------------------- */
$profe = new Profesor(0);
$datosProfesor = $profe->getId_Nombre_Correo(htmlentities($_POST['idc']));

if (!$datosProfesor) {
    echo json_encode('ERROR_GET_DATA_PROFESOR');
}

$idProfesor = $datosProfesor[0];
$nombreProfesor = $datosProfesor[1];
$correoProfesor = $datosProfesor[2];

/* --------------------------- Obtenemos el nombre de la clase --------------------------- */
$nombreClase = htmlentities($_POST['nombreClase']);

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
    $mail->addAddress($correoProfesor, $nombreProfesor);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Notificación de baja.';

    $mail->Body    = "<html lang='es'><body>";
    $mail->Body   .= "<h1>Estimado {$nombreProfesor}: Se te notifica que el alumno {$nombreAlumno} se ha dado de baja de tu clase {$nombreClase}.</h1>";
    $mail->Body   .= "<p>Para aceptar la baja de {$nombreAlumno} da clic en el siguiente enlace: <a href='http://localhost/sas/controladores/aceptarBaja.php?i={$alumno->getID()}&c={$nombreClase}'> Aceptar baja.";
    $mail->Body   .= "</a></p>";
    $mail->Body   .= "</body></html>";
                      
    $mail->AltBody = "Estimado {$nombreProfesor}:\r\nSe te notifica que el alumno {$nombreAlumno} se ha dado de baja de tu clase {$nombreClase}.";

    $mail->CharSet = 'UTF-8';
    $mail->send();

    echo json_encode('CORREO_ENVIADO');
} catch (Exception $e) {
    echo json_encode($e->errorMessage());
}
