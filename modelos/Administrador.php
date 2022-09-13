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
    public function registrarProfesor($nombre, $paterno, $materno, $correo, $usuario, $contraseña)
    {
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        if (!$conexion->connect_errno) {
            $consulta = $conexion->prepare('INSERT INTO usuario(nombre, paterno, materno, correo, usuario, contraseña, tipo) VALUES(?, ?, ?, ?, ?, ?, ?)');

            $tipo = 'profesor';

            $consulta->bind_param('sssssss', $nombre, $paterno, $materno, $correo, $usuario, $contraseña, $tipo);
            return $consulta->execute();
        }
    }
}
