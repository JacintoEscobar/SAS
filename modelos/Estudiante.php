<?php

class Estudiante
{
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    /**
     * Consulta las notificaciones del alumno para mostrarlas
     * y que pueda acceder a sus nuevos cuestionarios.
     */
    public function getNotificaciones()
    {
        try {
            $conexion = new mysqli('localhost', 'root', '', 'sas');

            $consulta = $conexion->prepare('SELECT * FROM notificacion WHERE idUsuario = ?');
            $consulta->bind_param('i', $this->id);

            $consulta->execute();

            return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    /**
     * Función que devuelve el nombre del estudiante.
     * Recibe un valor booleano para verificar si el id se encriptó previamente con md5.
     */
    public function getNombre($encriptado = false)
    {
        $conexion = new mysqli("localhost", "root", "", "sas");

        if (!$conexion->connect_errno) {

            /**
             * Verificamos si el id está encriptado.
             * Preparamos la consulta sql y asignamos los atributos de esta.
             */
            if ($encriptado) {
                $sql = $conexion->prepare('SELECT nombre FROM usuario WHERE md5(idUsuario) = ?');
                $sql->bind_param('s', $this->id);
            } else {
                $sql = $conexion->prepare('SELECT nombre FROM usuario WHERE idUsuario = ?');
                $sql->bind_param('i', $this->id);
            }
            $respuesta = $sql->execute();

            if ($respuesta) {
                return $sql->get_result()->fetch_row();
            }

            return false;
        }
    }

    /**
     * Función que devuelve el correo del estudiante.
     * Recibe un valor booleano para verificar si el id se encriptó previamente con md5.
     */
    public function getCorreo($encriptado = true)
    {
        $conexion = new mysqli("localhost", "root", "", "sas");

        if (!$conexion->connect_errno) {

            /**
             * Verificamos si el id está encriptado.
             * Preparamos la consulta sql y asignamos los atributos de esta.
             */
            if ($encriptado) {
                $sql = $conexion->prepare('SELECT correo FROM usuario WHERE md5(idUsuario) = ?');
                $sql->bind_param('s', $this->id);
            } else {
                $sql = $conexion->prepare('SELECT nombre FROM usuario WHERE idUsuario = ?');
                $sql->bind_param('i', $this->id);
            }
            $respuesta = $sql->execute();

            if ($respuesta) {
                return $sql->get_result()->fetch_row();
            }

            return false;
        }
    }

    public function getClases()
    {
        // Creamos la conexión con la base de datos
        $conexion = new mysqli("localhost", "root", "", "sas");

        if (!$conexion->connect_errno) {
            // Definimos la consulta para obtener las clases en las que el alumno está registrado
            $consulta = $conexion->prepare('SELECT clase.idClase, clase.nombre, codigo, estado FROM clase
                                            INNER JOIN inscripcion ON inscripcion.idClase = clase.idClase
                                            INNER JOIN usuario ON inscripcion.idUsuario = usuario.idUsuario
                                            WHERE inscripcion.idUsuario = ? AND estado IN(?, ?)');
            $estado1 = 'activo';
            $estado2 = 'pendiente';
            $consulta->bind_param('iss', $this->id, $estado1, $estado2);
            $respuesta = $consulta->execute();

            if ($respuesta) {
                $clases = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
                return $clases;
            } else {
                return array('ERROR' => $conexion->error);
            }
        } else {
            return array('ERROR_CONEXION_MYSQL' => 'Ocurrió un error al realizar la conexión con la base de datos.');
        }
    }

    public function unirseClase($codigoClase)
    {
        /* Creamos una conexión a la base de datos */
        $conexion = new mysqli("localhost", "root", "", "sas");

        if (!$conexion->connect_errno) {
            /* Definimos la consulta para obtener el id de la clase con el código proporcionado */
            $sql1 = $conexion->prepare('SELECT idClase FROM clase WHERE codigo = ?');
            $sql1->bind_param('s', $codigoClase);
            $respuestaConsulta = $sql1->execute();

            if ($respuestaConsulta) {
                /* Obtenemos los registros de la consulta, o sea 1 en este caso */
                $idClase = $sql1->get_result();

                /* Cerramos la conexión a la base de datos realizada previamente */
                $conexion->close();
                /* Creamos nuevamente otra conexión a la base de datos para poder realizar la segunda consulta */
                $conexion = new mysqli("localhost", "root", "", "sas");

                /* Definimos una consulta para insertar en la tabla iscripcion el id de la clase y del alumno */
                $sql2 = $conexion->prepare('INSERT INTO inscripcion (idClase, idUsuario) VALUES (?, ?)');
                $sql2->bind_param('ii', $idClase->fetch_row()[0], $this->id);
                $respuestaConsulta = $sql2->execute();

                if ($respuestaConsulta) {
                    return array('EXITO' => 'Inscripción realizada con éxito.');
                } else {
                    return array('ERROR_DE_INSERCIÓN' => $conexion->error);
                }
            } else {
                return array('ERROR_DE_CONSULTA' => $conexion->error);
            }
        } else {
            return array('ERROR_DE_CONEXION' => 'Ocurrió un error al intentar conectar con la base de datos.');
        }
    }

    public function solicitarBaja($idC)
    {
        /* Creamos una conexión a la base de datos */
        $conexion = new mysqli("localhost", "root", "", "sas");

        if (!$conexion->connect_errno) {
            $sql = $conexion->prepare('UPDATE inscripcion SET estado = ? WHERE idClase = ? AND idUsuario = ?');
            $estado = 'Pendiente';
            $sql->bind_param('sii', $estado, $idC, $this->id);

            $respuesta = $sql->execute();

            if ($respuesta) {
                return array('EXITO' => 'Hecho.');
            }

            return array('ERROR' => $conexion->error);
        }
    }
}
