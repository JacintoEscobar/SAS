<?php

include_once '../modelos/BD.php';

class Sistema extends BD
{
    function __construct()
    {
    }

    /**
     * Consulta todos los usuarios de la base de datos.
     * Para mostrarlos al administrador y permitirle la manipulación de la información.
     * @return mixed Arreglo con los objetos de los registros de usuarios de la bd.
     */
    public function consulta_usuarios()
    {
        try {
            $this->conectar();

            $sql = 'SELECT * FROM usuario';
            $consulta = $this->conexion->prepare($sql);

            $consulta->execute();

            return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
