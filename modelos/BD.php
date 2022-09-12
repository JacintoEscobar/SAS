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

        /* $zip = new ZipArchive();
        $nombreArchivoZIP = $this->database . '' . $fecha . '.zip';

        if (!$zip->open($nombreArchivoSQL, ZIPARCHIVE::CREATE)) {
            return 0;
        }

        $zip->addFile($nombreArchivoSQL);
        $zip->close();
        unlink($nombreArchivoSQL);

        header("Location: $nombreArchivoZIP"); */
    }

    public function getHost()
    {
        return $this->host;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getDatabase()
    {
        return $this->database;
    }
}
