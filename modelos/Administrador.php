<?php

class Administrador
{
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Función que inserta en la base de datos un nuevo registro de profesor
     * Recibe los campos del profesor
     */
    public function registrarProfesor(String $matricula, String $nombre, String $paterno, String $materno, String $correo, String $usuario, String $contraseña, String $tipoUsuario)
    {
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        if (!$conexion->connect_errno) {
            $consulta = $conexion->prepare('INSERT INTO usuario(matricula, nombre, paterno, materno, correo, usuario, contraseña, tipo) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');

            $consulta->bind_param('ssssssss', $matricula, $nombre, $paterno, $materno, $correo, $usuario, $contraseña, $tipoUsuario);

            return $consulta->execute();
        }
    }

    /**
     * Función que inserta en la base de datos un nuevo registro de alumno
     * Recibe los campos del alumno
     */
    public function registrarAlumno(String $matricula, String $nombre, String $paterno, String $materno, String $correo, String $usuario, String $contraseña, String $tipoUsuario)
    {
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        if (!$conexion->connect_errno) {
            $consulta = $conexion->prepare('INSERT INTO usuario(matricula, nombre, paterno, materno, correo, usuario, contraseña, tipo) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');

            $consulta->bind_param('ssssssss', $matricula, $nombre, $paterno, $materno, $correo, $usuario, $contraseña, $tipoUsuario);

            return $consulta->execute();
        }
    }
}
