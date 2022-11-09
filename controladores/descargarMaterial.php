<?php

session_start();

if (!isset($_SESSION['dir'])) {
    header('http://localhost/sas/vistas/Topico.php');
    die();
}

$dir = htmlspecialchars($_SESSION['dir'], ENT_QUOTES, 'UTF-8');

header("Location: {$dir}");
die();
