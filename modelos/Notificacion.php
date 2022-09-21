<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once('../vendor/autoload.php');

/**
 * Maneja las distintas notificaciones que se envían por email a los usuarios.
 * @author Jacinto Escobar Quezada
 * @author Laura Itzel Martínez Chávez
 */
class Notificacion
{
    private $mail;
    private String $subject;

    /**
     * @param String $subject Asunto que se le asignará al email
     */
    function __construct(String $subject)
    {
        $this->mail = new PHPMailer();
        $this->subject = $subject;
        $this->confEmail();
    }

    /**
     * Se configuran los parámetros para el envío correcto de la notificación
     */
    private function confEmail()
    {
        $this->mail->CharSet = 'utf-8';

        $this->mail->IsSMTP();

        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $this->mail->Host = 'smtp.gmail.com';

        $this->mail->Port = 465;
        /* $this->mail->Port = 587; */

        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        /* $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; */

        $this->mail->SMTPAuth = true;

        $this->mail->Username = 'sistanalisoci@gmail.com';

        // lanix: kcxwzcxrwrmzijxh
        // hp:    
        $this->mail->Password = 'kcxwzcxrwrmzijxh';

        $this->mail->setFrom('sistanalisoci@gmail.com', 'SAS');
    }

    /**
     * Se configuran los parámetros de identificación del correo.
     * @param String $correo Correo electrónico del destinatario
     * @param String $nombre Nombre del usuario
     * @param String $paterno Apellido paterno del usuario. Nulo por defecto en caso de que solo se le refiera por el nombre
     */
    private function confEmailParams(String $correo, String $nombre, String $paterno = null)
    {
        if ($paterno) {
            $this->mail->addReplyTo($correo, "{$nombre} {$paterno}");
            $this->mail->addAddress($correo, "{$nombre} {$paterno}");
        } else {
            $this->mail->addReplyTo($correo, $nombre);
            $this->mail->addAddress($correo, $nombre);
        }

        $this->mail->Subject = $this->subject;

        /* $this->mail->msgHTML(file_get_contents('contents.html'), __DIR__); */
        $this->mail->IsHTML(true);
    }

    /**
     * Se notifica al usuario, mediante correo electrónico, de su alta en el sistema.
     * @param String $correo Correo electrónico del usuario
     * @param String $nombre Nombre del usuario
     * @param String $paterno Apellido paterno del usuario
     * @param String $usuario Usuario de acceso al sistema para el usuario registrado
     * @param String $contraseña Contraseña de acceso al sistema para el usuario registrado
     */
    public function usuarioRegistrado(String $correo, String $nombre, String $paterno, String $usuario, String $contraseña)
    {
        $this->confEmailParams($correo, $nombre, $paterno);

        $this->mail->Body = "<!DOCTYPE html>
                            <html lang='es'>
                                <body>
                                    <h1>Estimado {$nombre} {$paterno}: Este correo es para notificarte que se te ha dado de alta en SAS.</h1> <br> 
                                    <p>Tus credenciales para ingresar al sistema son: <br>
                                        usuario: <strong>{$usuario}</strong> <br>
                                        contraseña: <strong>{$contraseña}</strong> <br>
                                        <i>Visita
                                            <a href='http://localhost/sas/vistas/Login.php'> SAS </a>
                                            para acceder al sistema.
                                        </i>
                                    </p> <br>
                                </body>
                            </html>";

        $this->mail->AltBody = "Estimado {$nombre} {$paterno}: Este correo es para notificarte que se te ha dado de alta en SAS.\r\n Tus credenciales de acceso son:\nusuario: {$usuario}
        contraseña: {$contraseña}\nVisita http://localhost/sas/vistas/Login.php para acceder al sistema.";

        //send the message, check for errors
        if (!$this->mail->send()) {
            return 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            $this->save_mail($this->mail);
            return "Hemos notificado al usuario sobre su registro en el sistema.";
        }
    }

    /**
     * Se notifica al profesor sobre la petición de baja de un alumno.
     * @param String $correo Correo electrónico del profesor
     * @param String $nombreP Nombre del profesor
     * @param String $nombreA Nombre del alumno
     * @param String $nombreC Nombre de la clase
     */
    public function solicitudBaja(String $correo, String $nombreP, String $nombreA, String $nombreC, String $idC, String $idA)
    {
        $this->confEmailParams($correo, $nombreP);

        /* $this->mail->msgHTML(file_get_contents('contents.html'), __DIR__); */
        $this->mail->IsHTML(true);
        $this->mail->Body = "<!DOCTYPE html>
                            <html lang='es'>
                                <body>
                                    <h1>Estimado {$nombreP}: Se te notifica que el alumno {$nombreA} ha solicitado su baja de tu clase {$nombreC}.</h1> <br> 
                                    <p> Para aceptar la baja de {$nombreA} da clic en el siguiente enlace:
                                        <a href='http://localhost/sas/controladores/aceptarBaja.php?ia={$idA}&ic={$idC}'> Aceptar baja </a>
                                    </p> <br>
                                </body>
                            </html>";

        $this->mail->AltBody = "Estimado {$nombreP}: Se te notifica que el alumno {$nombreA} ha solicitado su baja de tu clase {$nombreC}.\n\r
                                Para aceptar la baja de {$nombreA} da clic en el siguiente enlace: http://localhost/sas/controladores/aceptarBaja.php?ia={$idA}&ic={$idC}";

        //send the message, check for errors
        if (!$this->mail->send()) {
            return 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            $this->save_mail($this->mail);
            return "Hemos notificado al profesor sobre tu petición.";
        }
    }

    /**
     * Se notifica al alumno que su petición de baja ha sido aceptada por el profesor.
     * @param String $correo Correo electrónico del alumno
     * @param String $nombre Nombre del alumno
     * @param String $clase Clase de la que se dio de baja
     */
    public function bajaAceptada(String $correo, String $nombre, String $clase)
    {
        $this->confEmailParams($correo, $nombre);

        /* $this->mail->msgHTML(file_get_contents('contents.html'), __DIR__); */
        $this->mail->IsHTML(true);
        $this->mail->Body = "<!DOCTYPE html>
                            <html lang='es'>
                                <body>
                                    <h1>Estimado {$nombre}: Se te notifica que tu profesor ha aceptado tu petición de baja de tu clase {$clase}.</h1>
                                </body>
                            </html>";

        $this->mail->AltBody = "Estimado {$nombre}:\r\nSe te notifica que tu profesor ha aceptado tu petición de baja de tu clase {$clase}.";

        //send the message, check for errors
        if (!$this->mail->send()) {
            return 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            $this->save_mail($this->mail);
            return "Hemos notificado al profesor sobre tu petición.";
        }
    }

    private function save_mail($mail)
    {
        //You can change 'Sent Mail' to any other folder or tag
        $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
        $imapStream = imap_open($path, $mail->Username, $mail->Password);

        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);

        return $result;
    }
}
