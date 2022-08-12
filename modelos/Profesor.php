<?php

class Profesor
{
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function getClases()
    {
        // Creamos la conexión con la base de datos
        $conexion = new mysqli("localhost", "root", "", "sas");

        // Verificamos que no haya ocurrido algún error de conexión
        if (!$conexion->connect_errno) {
            // Preparamos la sentencia sql
            $sentencia = $conexion->prepare('SELECT idClase as id, nombre as titulo, codigo FROM clase WHERE idUsuario = ?');

            // Asignamos los parámetros de consulta
            $sentencia->bind_param('s', $this->id);

            // Ejecutamos la consulta
            $sentencia->execute();

            // Obtenemos los registros de la consulta
            $registros = $sentencia->get_result();

            // Obtenemos las clases como un arreglo asociativo
            $clases = $registros->fetch_all(MYSQLI_ASSOC);

            // Cerramos la conexión con la base de datos
            $conexion->close();

            // Devolvemos las clases dentro de un arreglo asociativo para devolverlas en la solicitud
            return array('CLASES' => $clases);
        } else {
            return array('ERROR_DE_CONEXION' => 'Ocurrió un error al realizar la conexión con la base de datos.');
        }
    }

    public function crearClase($titulo, $descripcion, $cuatrimestre, $carrera, $grupo)
    {
        // Creamos una conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        // Verificamos que no haya ocurrido algún error de conexión
        if (!$conexion->connect_errno) {
            // Preparamos la sentencia sql para crear la clase
            $sentencia = $conexion->prepare('INSERT INTO clase(nombre, descripcion, cuatrimestre, grupo, carrera, idUsuario) VALUES(?,?,?,?,?,?)');

            // Asignamos las variables de consulta
            $sentencia->bind_param('ssissi', $titulo, $descripcion, $cuatrimestre, $grupo, $carrera, $this->id);

            // Ejecutamos la consulta sql
            $respuesta = $sentencia->execute();

            if ($respuesta) {
                return array('EXITO' => 'Clase registrada con éxito.');
            } else {
                return array('ERROR_EJECUCION' => $conexion->error);
            }
        } else {
            return array('ERROR_CONEXION' => 'Ocurrió un error al crear la conexión con la base de datos.');
        }
    }

    public function eliminarClase($idClase)
    {
        // Creamos una conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        // Verificamos que no haya ocurrido algún error de conexión
        if (!$conexion->connect_errno) {
            // Preparamos la sentencia sql para crear la clase
            $sentencia = $conexion->prepare('DELETE FROM clase WHERE idClase = ? AND idUsuario = ?');

            // Asignamos las variables de consulta
            $sentencia->bind_param('ii', $idClase, $this->id);

            // Ejecutamos la consulta sql
            $respuesta = $sentencia->execute();

            if ($respuesta) {
                return array('EXITO' => 'Clase eliminada con éxito.');
            } else {
                return array('ERROR_EJECUCION' => $conexion->error);
            }
        } else {
            return array('ERROR_CONEXION' => 'Ocurrió un error al crear la conexión con la base de datos.');
        }
    }

    public function editarClase($codigo, $titulo, $descripcion, $cuatrimestre, $carrera, $grupo)
    {
        // Creamos una conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        // Verificamos que no haya ocurrido algún error de conexión
        if (!$conexion->connect_errno) {
            // Preparamos la sentencia sql para crear la clase
            $sentencia = $conexion->prepare('UPDATE clase SET nombre = ?, descripcion = ?, cuatrimestre = ?, carrera = ?, grupo = ? WHERE codigo = ?');

            // Asignamos las variables de consulta
            $sentencia->bind_param('ssisss', $titulo, $descripcion, $cuatrimestre, $carrera, $grupo, $codigo);

            // Ejecutamos la consulta sql
            $respuesta = $sentencia->execute();

            if ($respuesta) {
                return array('EXITO' => 'Información actualizada correctamente.');
            } else {
                return array('ERROR_EJECUCION' => $conexion->error);
            }
        } else {
            return array('ERROR_CONEXION' => 'Ocurrió un error al crear la conexión con la base de datos.');
        }
    }
}
