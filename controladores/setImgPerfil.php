<?php

$directorio = "../public/img/" . basename($_FILES['img_perfil']['name']);

if (!move_uploaded_file($_FILES['img_perfil']['tmp_name'], $directorio)) {
    echo '<script type="text/javascript">alert("Ocurrió un problemas al subir tu imagen de perfil.");</script>';
    header("Refresh:0; http://localhost/sas/vistas/Login.php");
    die();
}

include_once '../modelos/Usuario.php';

session_start();
$idU = htmlspecialchars($_SESSION['i'], ENT_QUOTES, 'UTF-8');

$usuario = new Usuario('', '');
$usuario->setID($idU);

// Actualizamos la bd con el nombre de la img.
if ($usuario->setImg(basename($_FILES['img_perfil']['name']))) {
    echo '<script type="text/javascript">alert("Imagen de perfil actualizada correctamente.");</script>';
} else {
    echo '<script type="text/javascript">alert("Ocurrió un problemas al subir tu imagen de perfil.");</script>';
}

header("Refresh:0; http://localhost/sas/vistas/Login.php");
die();
