<?php

include_once '../modelos/BD.php';
include_once '../modelos/Pregunta.php';

class Cuestionario extends BD
{
    private String $id;
    private String $titulo;
    private String $descripcion;
    private String $tipo;
    private String $idUsuario;

    function __construct(String $id = '', String $titulo = '', String $descripcion = '', String $tipo = '', String $idUsuario)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->idUsuario = $idUsuario;
    }

    /**
     * Realiza una consulta de eliminacion de pregunta.
     * @param string $idP
     */
    public function deletePregunta(String $idP)
    {
        try {
            $pregunta = new Pregunta($idP, '', '', $this->id);
            $pregunta->deleteRespuestas();

            $this->conectar();

            $sql = 'DELETE FROM pregunta WHERE idPregunta = ? AND idCuestionario = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param('ii', $idP, $this->id);

            $consulta->execute();

            $this->conexion->close();

            return;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Consulta todas las preguntas relacionadas al cuestionario.
     * @return array preguntas
     */
    public function getPreguntas()
    {
        try {
            $this->conectar();

            $sql = 'SELECT * FROM pregunta WHERE idCuestionario = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param('i', $this->id);

            $consulta->execute();

            $preguntas = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);

            $this->conexion->close();

            return $preguntas;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Inserta nuevas preguntas y sus respuestas en la bd.
     * @param array $preguntas
     * @param string $idC id del cuestionario al que pertenece la pregunta.
     * @return boolean|string Verdadero en caso de que se hayan insertado de manera correcta los registros | mensaje de la excepcion atrapada.
     */
    public function guardarCambios(array $preguntas, string $idC)
    {
        $num_preguntas = sizeof($preguntas);
        for ($i = 0; $i < $num_preguntas; $i++) {
            try {
                $pregunta = $preguntas[$i]['pregunta'];
                $res_ins_preg = $this->addPregunta($pregunta);

                $idPregunta = $this->getIdPregunta($pregunta, $idC);

                $respuestas = $preguntas[$i]['respuestas'];
                $num_respuestas = sizeof($respuestas);
                for ($j = 0; $j < $num_respuestas; $j++) {
                    $respuesta = $respuestas[$j];
                    $res_ins_resp = $this->addRespuesta($respuestas[$j], $idPregunta);
                }
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
        }

        return true;
    }

    /**
     * Inserta las respuestas de una pregunta.
     * @return boolean verdadero en caso de que la consulta se haya realizado correctamente.
     */
    private function addRespuesta(array $respuesta, string $idP)
    {
        try {
            $this->conectar();

            $sql = 'INSERT INTO respuestamultiple(contenido, tipo, idPregunta) VALUES(?, ?, ?)';
            $consulta = $this->conexion->prepare($sql);

            $contenido = $respuesta['contenido'];
            $tipo = $respuesta['tipo'];
            $consulta->bind_param('ssi', $contenido, $tipo, $idP);

            $consulta->execute();

            $this->conexion->close();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Devuelve el id de una pregunta en especifico basandose en la pregunta y el id del cuestionario.
     * @return string id de la pregunta.
     */
    private function getIdPregunta($pregunta, $idC)
    {
        try {
            $preguntaObj = new Pregunta('', $pregunta, '');
            return $preguntaObj->getIDPorConsulta($idC);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Inserta las nuevas preguntas en la bd.
     * @param string $pregunta Texto de la pregunta a insertar.
     * @return boolean verdadero en caso de que la consulta se haya realizado correctamente.
     * 
     */
    private function addPregunta(String $pregunta)
    {
        try {
            $this->conectar();

            $sql = 'INSERT INTO pregunta(pregunta, idCuestionario) VALUES(?, ?)';
            $consulta = $this->conexion->prepare($sql);

            $idCuestionario = $this->getID();
            $consulta->bind_param('si', $pregunta, $idCuestionario);

            $consulta->execute();

            $this->conexion->close();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    // Metodos SET.
    public function setID(String $id)
    {
        $this->id = $id;
    }

    // Metodos GET.
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

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
