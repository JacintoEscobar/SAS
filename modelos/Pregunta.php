<?php

include_once '../modelos/BD.php';

class Pregunta extends BD
{
    private String $id;
    private String $pregunta;
    private String $idCuestionario;

    function __construct($id = '', String $pregunta = '', String $idC = '')
    {
        $this->id = $id;
        $this->pregunta = $pregunta;
        $this->idCuestionario = $idC;
    }

    /**
     * Realiza una consulta de eliminacion de todas las respuestas de una pregunta.
     * @param String idP
     */
    public function deleteRespuestas()
    {
        try {
            $this->conectar();

            $sql = 'DELETE FROM respuestamultiple WHERE idPregunta = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param('i', $this->id);

            $consulta->execute();

            $this->conexion->close();

            return;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Consulta todas las respuestas de la pregunta.
     * @return array respuestas.
     */
    public function getRespuestas()
    {
        try {
            $this->conectar();

            $sql = 'SELECT * FROM respuestamultiple WHERE idPregunta = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param('i', $this->id);

            $consulta->execute();

            $respuestas = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);

            $this->conexion->close();

            return $respuestas;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    /**
     * Consulta el id de la pregunta segun un parametro
     * atributo de la tabla pregunta
     * @param string $idC id del cuestionario al que pertenece la pregunta.
     * @return string id de la pregunta.
     */
    public function getIDPorConsulta()
    {
        try {
            $this->conectar();

            $sql = 'SELECT idPregunta FROM pregunta WHERE pregunta = ? AND idCuestionario = ?';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('si', $this->pregunta, $this->idCuestionario);

            $consulta->execute();
            $id = $consulta->get_result()->fetch_row()[0];

            $this->conexion->close();

            return $id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
