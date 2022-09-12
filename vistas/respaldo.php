<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sas';

$fecha = date('d-m-Y');
$nombreArchivoSQL = $database . '_' . $fecha . '.sql';

$dump = "mysqldump --add-drop-database --add-drop-table --add-drop-trigger -u root -h localhost -p $database > $nombreArchivoSQL";

system($dump, $output);

$zip = new ZipArchive();
$nombreArchivoZIP = $database . '' . $fecha . '.zip';

if ($zip->open($nombreArchivoSQL, ZIPARCHIVE::CREATE)) {
    $zip->addFile($nombreArchivoSQL);
    $zip->close();
    unlink($nombreArchivoSQL);

    header('Content-Disposition: filename='.$nombreArchivoZIP);
} else {
    echo "error";
}
