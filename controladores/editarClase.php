<?php

include '../modelos/Profesor.php';

session_start();

if (isset($_POST)) {
    if (isset($_POST['codigo']) && isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['cuatrimestre']) && isset($_POST['carrera']) && isset($_POST['grupo'])) {
        // Obtenemos los datos enviados en el formulario
        $codigo = htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
        $cuatrimestre = htmlspecialchars($_POST['cuatrimestre'], ENT_QUOTES, 'UTF-8');
        $carrera = htmlspecialchars($_POST['carrera'], ENT_QUOTES, 'UTF-8');
        $grupo = htmlspecialchars($_POST['grupo'], ENT_QUOTES, 'UTF-8');

        $profesor = new Profesor($_SESSION['i']);

        $respuesta = $profesor->editarClase($codigo, $titulo, $descripcion, $cuatrimestre, $carrera, $grupo);

        echo json_encode($respuesta);
    } else {
        echo json_encode(array('ERROR_POST_DATOS' => 'Ocurrió un errro con los datos de la petición.'));
    }
} else {
    echo json_encode(array('ERROR_POST' => 'Ocurrió un errro con la petición.'));
}
