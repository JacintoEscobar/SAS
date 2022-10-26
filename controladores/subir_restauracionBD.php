<?php

// Subimos el archivo seleccionado por el usuario.
$dir_server = '../restauraciones/';
$dir_archivo = $dir_server . basename($_FILES['archivo_restauracion']['name']);

if (move_uploaded_file($_FILES['archivo_restauracion']['tmp_name'], $dir_archivo)) {
    header("Location: http://localhost/sas/vistas/GestionBD.php?subida=true");
    die();
} else {
    header("Location: http://localhost/sas/vistas/GestionBD.php?subida=false");
    die();
}
