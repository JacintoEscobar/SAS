<?php

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
$dir_server = '../respaldos/';
$dir_archivo = $dir_server . basename($nombreArchivo);

$dump = "C:/xampp/mysql/bin/mysqldump.exe --add-drop-database --add-drop-table --databases sas -h{$host} -u{$user} -p{$pass} > {$dir_archivo}";

system($dump, $output);

header("Location: {$dir_archivo}");
