<?php

include_once '../modelos/MaterialEducativo.php';

$idME = htmlspecialchars($_POST['idME'], ENT_QUOTES, 'UTF-8');

$materialEducativo = new MaterialEducativo();

try {
    if ($materialEducativo->eliminar($idME)) {
        echo json_encode('Material educativo eliminado correctamente.');
        die();
    }
} catch (\Throwable $th) {
    echo json_encode(['ERROR' => $th->getMessage()]);
    die();
}

echo json_encode(['ERROR' => 'Ocurrió un error al eliminar el material educativo.']);
die();
