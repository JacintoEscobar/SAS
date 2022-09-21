<?php

include '../modelos/BD.php';

class UnidadAprendizaje extends BD
{
    private $id;
    private $titulo;
    private $descripcion;
    private $idC;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Obtiene de la bd los tópicos.
     * @return String|mixed Retorna el mensaje de error que haya ocurrido o los tópicos como un arreglo asociativo
     */
    public function getTopicos()
    {
        // Realizamos la conexión a la base de datos.
        if ($this->conectar()) {
            try {
                // Preparamos la consulta sql.
                $sql = 'SELECT * FROM topico WHERE idUnidadAprendizaje = ? ORDER BY idTopico DESC';
                $consulta = $this->conexion->prepare($sql);

                // Asignamos los parámetros de consulta.
                $consulta->bind_param('i', $this->id);

                /**
                 * Ejecutamos la consulta sql y verificamos que esta
                 * se haya realizado correctamente para obtener
                 * los registros de los tópicos.
                 */
                if ($consulta->execute()) {
                    // Obtenemos los registros de la base de datos.
                    $registros = $consulta->get_result();

                    // Devolvemos los registros.
                    return $registros->fetch_all(MYSQLI_ASSOC);
                }

                return 'ERROR_SQL';
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
        }

        return 'ERROR_DE_CONEXION';
    }
}
