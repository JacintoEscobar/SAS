<?php

session_start();

if (isset($_SESSION)) {
    if (isset($_SESSION['i']) && isset($_SESSION['u']) && isset($_SESSION['t'])) {
        if ($_SESSION['t'] == 'administrador') {
            header("Location: ../vistas/HomeAdministrador.php");
        } else if ($_SESSION['t'] == 'profesor') {
            header("Location: ../vistas/HomeProfesor.php");
        } else {
            header("Location: ../vistas/HomeAlumno.php");
        }
        die();
    }
}
