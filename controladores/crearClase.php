<?php

include '../modelos/Profesor.php';

session_start();

if (isset($_POST)) {
    if (isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['cuatrimestre']) && isset($_POST['carrera']) && isset($_POST['grupo'])) {
        // Obtenemos los datos enviados en el formulario
        $titulo = htmlentities($_POST['titulo']);
        $descripcion = htmlentities($_POST['descripcion']);
        $cuatrimestre = htmlentities($_POST['cuatrimestre']);
        $carrera = htmlentities($_POST['carrera']);
        $grupo = htmlentities($_POST['grupo']);

        $profesor = new Profesor($_SESSION['i']);

        $respuesta = $profesor->crearClase($titulo, $descripcion, $cuatrimestre, $carrera, $grupo);

        echo json_encode($respuesta);
    } else {
        echo json_encode(array('ERROR_POST_DATOS' => 'Ocurrió un errro con los datos de la petición.'));
    }
} else {
    echo json_encode(array('ERROR_POST' => 'Ocurrió un errro con la petición.'));
}
