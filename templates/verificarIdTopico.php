<?php

if (!isset($_GET['i'])) {
    if (!isset($_SESSION['idT'])) {
        header("Location: http://localhost/sas/vistas/Login.php");
        die();
    } else {
        $idT = htmlspecialchars($_SESSION['idT'], ENT_QUOTES, 'UTF-8');
    }
} else {
    $idT = htmlspecialchars($_GET['i'], ENT_QUOTES, 'UTF-8');
}
