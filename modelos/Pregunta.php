<?php

include_once '../modelos/BD.php';

class Pregunta extends BD
{
    private String $id;
    private String $pregunta;

    function __construct($id = '', String $pregunta)
    {
        $this->id = $id;
        $this->pregunta = $pregunta;
    }

    /**
     * Consulta el id de la pregunta segun un parametro
     * atributo de la tabla pregunta
     * @param string $idC id del cuestionario al que pertenece la pregunta.
     * @return string id de la pregunta.
     */
    public function getIDPorConsulta(string $idC)
    {
        try {
            $this->conectar();

            $sql = 'SELECT idPregunta FROM pregunta WHERE pregunta = ? AND idCuestionario = ?';
            $consulta = $this->conexion->prepare($sql);

            $pregunta = $this->pregunta;
            $consulta->bind_param('si', $pregunta, $idC);

            $consulta->execute();
            $id = $consulta->get_result()->fetch_row()[0];

            $this->conexion->close();

            return $id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
