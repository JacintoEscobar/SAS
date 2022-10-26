<?php

$host = 'localhost';
$user = 'chinto';
$pass = 'Jacinto_107';
$bd = 'sas';

$fecha = date('Y-m-d');

$nombreArchivo = "respaldo_{$bd}_{$fecha}.sql";

/* mysqldump --add-drop-database --databases sas -h localhost -u root -p > */
$dump = "C:/xampp/mysql/bin/mysqldump.exe --add-drop-database --add-drop-table --databases sas -h{$host} -u{$user} -p{$pass} > {$nombreArchivo}";

system($dump, $output);

header("Location: {$nombreArchivo}");