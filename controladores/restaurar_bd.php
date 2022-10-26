<?php

$codigo_sas = htmlspecialchars($_POST['codigo_sas'], ENT_QUOTES, 'UTF-8');
$codigo_usuario = htmlspecialchars($_POST['codigo_usuario'], ENT_QUOTES, 'UTF-8');

if (strcmp($codigo_usuario, $codigo_sas) == 0) {
    // Credenciales para realizar la conexión con mysql.
    $host = 'localhost';
    $user = 'chinto';
    $pass = 'Jacinto_107';
    $bd = 'sas';

    // Fecha que se pondrá en el nombre del archivo .sql.
    $fecha = date('Y-m-d');

    // Nombramos el archivo de respaldo.
    $nombreArchivo = "respaldo_{$bd}_{$fecha}.sql";

    // Definimos la dirección donde se almacenará el archivo de respaldo.
    $dir_server = '../restauraciones/';
    $dir_archivo = $dir_server . basename($nombreArchivo);

    $dump = "C:/xampp/mysql/bin/mysql.exe -h{$host} -u{$user} -p{$pass} {$bd} < {$dir_archivo}";

    $respuesta = system($dump);

    if (gettype($respuesta) == 'string') {
        header('Location: http://localhost/sas/vistas/GestionBD.php?r=true');
    } else {
        header('Location: http://localhost/sas/vistas/GestionBD.php?r=false');
    }
} else {
    header('Location: http://localhost/sas/vistas/GestionBD.php?r=false');
}
