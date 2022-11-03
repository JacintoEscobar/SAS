<?php

include_once "../modelos/Cuestionario.php";

$cuestionario = new Cuestionario(htmlspecialchars($_GET["idCuestionario"], ENT_QUOTES, 'UTF-8'), '', '', '', '');

echo json_encode(['EsAsignado' => $cuestionario->isAsignado()]);
