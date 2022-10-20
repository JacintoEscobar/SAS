<?php

include '../modelos/Notificacion.php';

/**
 * Obtenemos los datos del estudiante para notificarle de su alta en el sistema
 */
$nombre = htmlspecialchars($_POST['n'], ENT_QUOTES, 'UTF-8');
$paterno = htmlspecialchars($_POST['p'], ENT_QUOTES, 'UTF-8');
$correo = htmlspecialchars($_POST['co'], ENT_QUOTES, 'UTF-8');
$usuario = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');
$contraseña = htmlspecialchars($_POST['con'], ENT_QUOTES, 'UTF-8');

/**
 * Creamos una notificación para enviar el correo al nuevo usuario
 */
$notificacion = new Notificacion('Notificación de registro en SAS.');

/**
 * Enviamos la notificación
 */
echo json_encode($notificacion->usuarioRegistrado($correo, $nombre, $paterno, $usuario, $contraseña));

