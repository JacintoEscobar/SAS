<?php

// Verificamos que se haya obtenido al menos un cuestionario.
$num_cuestionarios = sizeof($cuestionarios_no_asignados);
if ($num_cuestionarios > 0) {
    // Creamos el html de los cuestionarios disponibles para asignar.
    for ($i = 0; $i < $num_cuestionarios; $i++) {
        echo
        '<p id="pCuestionario" t="' . $cuestionarios_no_asignados[$i]["titulo"] . '" idC="' . $cuestionarios_no_asignados[$i]["idCuestionario"] . '">' . $cuestionarios_no_asignados[$i]["titulo"] . '</p>';
    }
}
