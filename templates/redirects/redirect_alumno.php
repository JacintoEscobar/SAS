<?php

session_start();

if (isset($_SESSION)) {
    if (isset($_SESSION['i']) && isset($_SESSION['u']) && isset($_SESSION['t'])) {
        if ($_SESSION['t'] != 'alumno') {
            echo '<script> alert("No tienes autorización para ver esta página.")</script>';
            
            if ($_SESSION['t'] == 'profesor') {
                header("Location: ../vistas/HomeProfesor.php");
                die();
            } else {
                header("Location: ../vistas/HomeAdministrador.php");
                die();
            }
        }
    } else {
        header("Location: ../vistas/Login.php");
        die();
    }
} else {
    header("Location: ../vistas/Login.php");
    die();
}
