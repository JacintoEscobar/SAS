<?php

class Clase
{
    private $id;
    private $nombre;
    private $descripcion;
    private $cuatrimestre;
    private $grupo;
    private $carrera;
    private $codigo;

    function __construct($codigo, $id = null)
    {
        $this->codigo = $codigo;
        $this->id = $id;
    }

    public function getNombreCorreoProfesor($idProfesor)
    {
        $conexion = new mysqli("localhost", "root", "", "sas");

        if (!$conexion->connect_errno) {
            $sql = $conexion->prepare(
                '
                SELECT usuario.nombre AS profesor, usuario.correo AS correo FROM usuario
                INNER JOIN clase ON usuario.idUsuario = clase.idClase
                WHERE usuario.idUsuario = ?'
            );
            $sql->bind_param('i', $idProfesor);
            $respuesta = $sql->execute();

            if ($respuesta) {
                return $sql->get_result()->fetch_row();
            }

            return false;
        }
    }

    /**
     * Función que obtiene los datos de una clase y los asigna al objeto.
     * Recibe true o false para realizar la consulta con el código de clase o con el id encriptado
     */
    public function getDatos($idEncriptado = false)
    {
        // Creamos la conexión con la base de datos
        $conexion = new mysqli("localhost", "root", "", "sas");

        // Verificamos que no haya ocurrido algún error de conexión
        if (!$conexion->connect_errno) {
            if ($idEncriptado) {
                // Preparamos la sentencia sql
                $sentencia = $conexion->prepare('SELECT nombre, descripcion, cuatrimestre, grupo, carrera FROM clase WHERE md5(idClase) = ?');

                // Asignamos los parámetros de consulta
                $sentencia->bind_param('s', $this->id);
            } else {
                // Preparamos la sentencia sql
                $sentencia = $conexion->prepare('SELECT nombre, descripcion, cuatrimestre, grupo, carrera FROM clase WHERE codigo = ?');

                // Asignamos los parámetros de consulta
                $sentencia->bind_param('s', $this->codigo);
            }

            // Ejecutamos la consulta
            $sentencia->execute();

            // Obtenemos el registro de la consulta
            $registros = $sentencia->get_result();

            // Obtenemos las clases como un arreglo asociativo
            $datos = $registros->fetch_assoc();

            // Cerramos la conexión con la base de datos
            $conexion->close();

            // Asignamos los valores de los campos a la clase
            $this->nombre = $datos['nombre'];
            $this->descripcion = $datos['descripcion'];
            $this->cuatrimestre = $datos['cuatrimestre'];
            $this->grupo = $datos['grupo'];
            $this->carrera = $datos['carrera'];
        } else {
            return array('ERROR_DE_CONEXION' => 'Ocurrió un error al realizar la conexión con la base de datos.');
        }
    }

    public function verificarClase()
    {
        // Creamos la conexión con la base de datos
        $conexion = new mysqli("localhost", "root", "", "sas");

        // Verificamos que no haya ocurrido algún error de conexión
        if (!$conexion->connect_errno) {
            // Preparamos la sentencia sql
            $sentencia = $conexion->prepare('SELECT * FROM clase WHERE codigo = ?');

            // Asignamos los parámetros de consulta
            $sentencia->bind_param('s', $this->codigo);

            // Ejecutamos la consulta
            $sentencia->execute();

            // Obtenemos el registro de la consulta
            $registros = $sentencia->get_result();

            // Cerramos la conexión con la base de datos
            $conexion->close();

            // Verificamos que los registros devueltos sean 1
            if ($registros->num_rows == 1) {
                return array('EXITO' => 'Se ha inscrito de manera exitosa en la clase.');
            } else {
                return array('ERROR' => "No existe la clase con código: $this->codigo.");
            }
        } else {
            return array('ERROR_DE_CONEXION' => 'Ocurrió un error al realizar la conexión con la base de datos.');
        }
    }

    public function getID()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getCuatri()
    {
        return $this->cuatrimestre;
    }
    public function getGrupo()
    {
        return $this->grupo;
    }
    public function getCarrera()
    {
        return $this->carrera;
    }
}
