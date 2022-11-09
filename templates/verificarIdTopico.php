<?php

if (!isset($_GET['i'])) {
    header("Location: http://localhost/sas/vistas/Login.php");
    die();
}
$idT = htmlspecialchars($_GET['i'], ENT_QUOTES, 'UTF-8');
