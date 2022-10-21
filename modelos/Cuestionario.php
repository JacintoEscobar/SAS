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
     * 
     */
    public function isAsignado()
    {
        try {
            $this->conectar();

            $consulta = $this->conexion->prepare('SELECT * FROM asignacion WHERE idCuestionario = ?');

            $consulta->bind_param('i', $this->id);

            $consulta->execute();

            return sizeof($consulta->get_result()->fetch_all(MYSQLI_ASSOC)) > 0;
        } catch (Exception $ex) {
            throw $ex;
        }
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
     * 
     */
    public function actualizarRespuesta($respuesta)
    {
        try {
            $this->conectar();

            $sql = 'UPDATE respuestamultiple SET tipo = ? WHERE idrespuestamultiple = ?';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('si', $respuesta->tipo, $respuesta->id);

            $consulta->execute();

            $this->conexion->close();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Inserta las respuestas de una pregunta.
     * @return boolean verdadero en caso de que la consulta se haya realizado correctamente.
     */
    public function addRespuesta($respuesta, string $idP)
    {
        try {
            $this->conectar();

            $sql = 'INSERT INTO respuestamultiple(contenido, tipo, idPregunta) VALUES(?, ?, ?)';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('ssi', $respuesta->contenido, $respuesta->tipo, $idP);

            $consulta->execute();

            $this->conexion->close();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     */
    public function actualizarPregunta($pregunta)
    {
        try {
            $this->conectar();

            $sql = 'UPDATE pregunta SET pregunta = ? WHERE idPregunta = ?';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('si', $pregunta->pregunta, $pregunta->id);

            $consulta->execute();

            $this->conexion->close();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Inserta las nuevas preguntas en la bd.
     * @param string $pregunta Texto de la pregunta a insertar.
     * @return boolean verdadero en caso de que la consulta se haya realizado correctamente.
     */
    public function addPregunta(String $pregunta)
    {
        try {
            $this->conectar();

            $sql = 'INSERT INTO pregunta(pregunta, idCuestionario) VALUES(?, ?)';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('si', $pregunta, $this->id);

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
