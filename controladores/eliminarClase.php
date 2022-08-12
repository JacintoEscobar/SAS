<?php

include '../modelos/Profesor.php';

session_start();

if (isset($_POST)) {
    if (isset($_POST['id'])) {
        // Creamos un objeto Profesor que nos permita ejecutar la consulta para eliminar la clase
        $profesor = new Profesor($_SESSION['i']);

        // Llamamos a la función para intentar eliminar la clase
        $resultado = $profesor->eliminarClase($_POST['id']);

        echo json_encode($resultado);
    } else {
        echo json_encode(array('ERROR_POST_DATO' => 'Ocurrió un error con la información enviada en el formulario.'));
    }
} else {
    echo json_encode(array('ERROR_POST' => 'Ocurrió un error al enviar el formulario.'));
}
