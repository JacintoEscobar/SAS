<?php

class BD
{
    private String $host = 'localhost';
    private String $user = 'root';
    private String $password = '';
    private String $database = 'sas';
    private mysqli $conexion;

    function __construct()
    {
    }

    /**
     * Función para conectar con la base de datos.
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

    public function respaldar()
    {
        $fecha = date('d-m-Y');
        $nombreArchivoSQL = $this->database . '_' . $fecha . '.sql';

        $dump = "mysqldump -h$this->host -u$this->user -p$this->password --opt $this->database > $nombreArchivoSQL";

        system($dump, $output);

        $zip = new ZipArchive();
        $nombreArchivoZIP = $this->database . '_' . $fecha . '.zip';

        if (!$zip->open($nombreArchivoSQL, ZipArchive::CREATE)) { return "Ocurrió un error al crear el respaldo de la base de datos."; }

        $zip->addFile($nombreArchivoSQL);
        $zip->close();
        unlink($nombreArchivoSQL);

        header("Location: $nombreArchivoZIP");
    }
}
