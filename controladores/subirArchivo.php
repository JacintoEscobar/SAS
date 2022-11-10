<?php

// Verificamos que la petición POST sea válida.
if (!isset($_POST)) {
    header("Location: http://localhost/sas/vistas/Login.php");
    die();
}

// Verificamos que el archivo seleccionado por el profesor haya sido válido.
if (!isset($_FILES['meFile'])) {
    echo json_encode(['ERROR' => 'ERROR_ARCHIVO']);
    die();
}

// Obtenemos el nombre del archivo y asignamos su dirección en el servidor.
$dir = '../material-educativo/';
$dir_archivo = $dir . basename($_FILES['meFile']['name']);

// Subimos el archivo y verificamos la subida.
if (!move_uploaded_file($_FILES['meFile']['tmp_name'], $dir_archivo)) {
    echo json_encode(['ERROR' => 'ERROR_SUBIDA']);
    die();
}

// Registramos el nuevo material educativo en la bd.
session_start();

include_once '../modelos/MaterialEducativo.php';

$materialEducativo = new MaterialEducativo($_FILES['meFile']['name'], $dir_archivo, $_SESSION['idT'], htmlspecialchars($_POST['idE'], ENT_QUOTES, 'UTF-8'), 'archivo');
try {
    if ($materialEducativo->insertar()) {

        // Preparamos la distribución del material educativo.
        // 1. Obtenemos el id del material educativo.
        $idMaEd = MaterialEducativo::getMaterial($_FILES['meFile']['name'], $dir_archivo, $_SESSION['idT'], htmlspecialchars($_POST['idE'], ENT_QUOTES, 'UTF-8'), 'archivo');

        // 1. Obtenemos a los alumnos inscritos en la clase y cuya etiqueta sea igual a la del material educativo.
        include_once './getAlumnosInscritos.php';
        $alumnos = getAlumnosInscritos(htmlspecialchars($_POST['idE'], ENT_QUOTES, 'UTF-8'), $idMaEd, $_SESSION['idC']);

        // 2. Registramos en la bd la distribución material-alumno.
        include_once './distribuirMaterial.php';
        foreach ($alumnos as $alumno) {
            if (!distribuirMaterial($idMaEd, $alumno->idU)) {
                echo json_encode(['ERROR' => 'ERROR_REGISTRO']);
                die();
            }
        }

        echo json_encode('Material educativo subido de exitosamente.');
        die();
    }
} catch (\Throwable $th) {
    echo json_encode(['ERROR_FATAL' => $th->getMessage()]);
    die();
}

echo json_encode(['ERROR' => 'ERROR_REGISTRO']);
die();
