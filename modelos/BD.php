<?php

class BD
{
    private String $host = 'localhost';
    private String $user = 'root';
    private String $password = '';
    private String $database = 'sas';
    protected mysqli $conexion;

    function __construct()
    {
    }

    /**
     * Se realiza una conexión con la base de datos.
     */
    public function conectar()
    {
        $this->conexion = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        if ($this->conexion->connect_errno) {
            $this->conexion->close();
            return false;
        }
        return true;
    }

    /**
     * Se elimina la conexión con la base de datos.
     */
    public function desconectar()
    {
        $this->conexion->close();
    }
}
