<?php

include_once '../modelos/Sistema.php';

$sas = new Sistema();
try {
    $usuarios = $sas->consulta_usuarios();
    echo json_encode($usuarios);
} catch (Exception $ex) {
    throw $ex;
}
