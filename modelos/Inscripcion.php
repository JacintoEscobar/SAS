<?php

class Inscripcion
{
    function __construct()
    {
    }

    /**
     * Función que actualiza el estado de una inscripción.
     * Recibe el id de la clase y del usuario de la inscripción.
     * Devuelve true si se actualizó correctamente la tabla o false en caso contrario.
     */
    public function setEstado(String $idClase, String $idUsuario)
    {
        /**
         * Creamos una conexión a la base de datos.
         */
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        /**
         * Verificamos que no haya ocurrido un error en la conexión.
         */
        if (!$conexion->connect_errno) {
            /**
             * Preparamos la consulta, asignamos los valores de la consulta y la ejecutamos.
             */
            $sql = $conexion->prepare('UPDATE inscripcion SET estado = ? WHERE md5(idClase) = ? AND md5(idUsuario) = ?');
            $estado = 'Baja';
            $sql->bind_param('sss', $estado, $idClase, $idUsuario);

            return $sql->execute();
        }

        return false;
    }
}
