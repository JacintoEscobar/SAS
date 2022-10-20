<?php

include '../modelos/Clase.php';

if (isset($_GET) && isset($_GET['c'])) {
    //Creamos un objeto clase para poder obtener su información
    $clase = new Clase(htmlspecialchars($_GET['c'], ENT_QUOTES, 'UTF-8'));

    $clase->getDatos();

    echo json_encode(
        array(
            'DATOS' => [
                'nombre' => $clase->getNombre(),
                'descripcion' => $clase->getDescripcion(),
                'cuatrimestre' => $clase->getCuatri(),
                'grupo' => $clase->getGrupo(),
                'carrera' => $clase->getCarrera()
            ]
        )
    );
} else {
    echo json_encode(
        array('ERROR_GET' => 'Ocurrió un error con el dato "código" de la clase. Notifique al área de sistemas.')
    );
}
