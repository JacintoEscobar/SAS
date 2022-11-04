<?php

include_once '../modelos/Usuario.php';

$usuario = new Usuario('', '');
$usuario->setID(htmlspecialchars($_SESSION['i'], ENT_QUOTES, 'UTF-8'));

$img = $usuario->getImg();
