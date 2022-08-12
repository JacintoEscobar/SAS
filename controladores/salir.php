<?php

session_start();

session_destroy();

echo json_encode(array('EXITO' => 'Hasta luego :3'));