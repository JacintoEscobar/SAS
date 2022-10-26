<?php

// Subimos el archivo seleccionado por el usuario.
$dir_server = '../src/restaurar_sql/';
$dir_archivo = $dir_server . basename($_FILES['archivo_restauracion']['name']);

if (move_uploaded_file($_FILES['archivo_restauracion']['tmp_name'], $dir_archivo)) {
    // Ejecutamos el codigo para la restauración de la base de datos.
    $host = 'localhost';
    $user = 'chinto';
    $pass = 'Jacinto_107';
    $bd = 'sas';
    $dump = "C:/xampp/mysql/bin/mysql.exe -h{$host} -u{$user} -p{$pass} {$bd} < {$dir_archivo}";
    system($dump);

    echo '
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Yei!</strong> Restauración exitosa.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
} else {
    echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Yei!</strong> Ocurrió un error al realizar la restauración de la base de datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}