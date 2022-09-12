<?php

include '../modelos/Estudiante.php';
include '../modelos/Clase.php';
include '../modelos/Profesor.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../modelos/PHPMailer-master/src/Exception.php';
require '../modelos/PHPMailer-master/src/PHPMailer.php';
require '../modelos/PHPMailer-master/src/SMTP.php';

// Iniciamos $_SESSION para obtener el id del alumno
session_start();

// Obtenemos el nombre del alumno que se dio de baja
$alumno = new Estudiante($_SESSION['i']);
$datosAlumno = $alumno->getNombre();

if (!$datosAlumno) {
    echo json_encode('ERROR_GET_NOMBRE_ALUMNO');
}

$nombreAlumno = $datosAlumno[0]; // Se obtiene el nombre del alumno

// Obtenemos el id del profesor para poder obtener la informacion de la clase
$profe = new Profesor(null);
$idProfesor = $profe->getID(htmlentities($_POST['idc']));

// Obtenemos el nombre de la clase y el nombre del profesor que la imparte
$clase = new Clase(null);
$datosProfesorClase = $clase->getNombreCorreoProfesor(htmlentities($_POST['idc']));

if (!$datosProfesorClase) {
    echo json_encode('ERROR_GET_NOMBRE_CLASE_PROFESOR');
}
$clase = $datosProfesorClase[0];           // Se obtiene el nombre de la clase
$nombreProfesor = $datosProfesorClase[1];  // Se obtiene el nombre del profesor
$correoProfesor = $datosProfesorClase[2];  // Se obtiene el correo del profesor

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
    $mail->addAddress($correoProfesor, $nombreProfesor);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Notificación de baja.';
    $mail->Body    = "<h1>Estimado {$nombreProfesor}:\r\nSe te notifica que el alumno {$nombreAlumno} se ha dado de baja de tu clase {$clase}.</h1>";
    $mail->AltBody = "Estimado {$nombreProfesor}:\r\nSe te notifica que el alumno {$nombreAlumno} se ha dado de baja de tu clase {$clase}.";

    $mail->CharSet = 'UTF-8';
    $mail->send();

    echo json_encode('CORREO_ENVIADO');
} catch (Exception $e) {
    echo json_encode('CORREO_NO_ENVIADO');
}

