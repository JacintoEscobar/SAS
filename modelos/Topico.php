<?php

include_once '../modelos/BD.php';

class Topico extends BD
{
    private $id;
    private String $titulo;
    private String $descripcion;
    private String $idUA;

    function __construct($id = '', String $titulo, String $descripcion, String $idUA)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->idUA = $idUA;
    }

    /**
     * Elimina un tópico de la base de datos.
     * @return String Mensaje de error o de éxito.
     */
    public function eliminar()
    {
        // Realizamos la conexión con la bd.
        if ($this->conectar()) {
            try {
                // Preparamos la consulta sql de la eliminación.
                $sql = 'DELETE FROM topico WHERE idUnidadAprendizaje = ? AND titulo = ? AND descripcion = ?';
                $consulta = $this->conexion->prepare($sql);

                // Asignamos los parámetros de consulta.
                $consulta->bind_param('iss', $this->idUA, $this->titulo, $this->descripcion);

                // Ejecutamos la consulta y verificamos que no haya ocurrido ningún error.
                if ($consulta->execute()) {
                    if ($consulta->affected_rows > 0) {
                        return 'El tópico se ha eliminado correctamente.';
                    }
                }

                return $consulta->error;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
        }

        return 'Ocurrió un error al conectarse con la base de datos.';
    }

    // Métodos get
    public function getID()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getIDUA()
    {
        return $this->idUA;
    }
}
