<?php

include_once '../modelos/BD.php';

class Profesor extends BD
{
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Realiza la consulta sql para eliminar un cuestionario de la base de datos.
     * @param Cuestionario $cuestionario cuestionario a ser eliminado de la bd.
     */
    public function eliminarCuestionario(Cuestionario $cuestionario)
    {
        // Realizamos la conexion con la bd y verificamos
        // que no haya ocurrido algun error.
        if ($this->conectar()) {
            // Definimos la consulta a realizar.
            $sql = 'DELETE FROM cuestionario WHERE idCuestionario = ? AND idUsuario = ?';

            // Preparamos la consulta a ejecutar.
            $consulta = $this->conexion->prepare($sql);

            // Asignamos los parametros de la consulta.
            $idC = $cuestionario->getID();
            $consulta->bind_param('ii', $idC, $this->id);

            // Ejecutamos la consulta.
            if ($consulta->execute() && $consulta->affected_rows == 1)
                return 'Cuestionario eliminado satisfactoriamente.';

            return $this->conexion->error;
        }

        return 'Ocurrio un error al realizar la conexión con la base de datos. Favor de reportar la falla.';
    }

    /**
     * Se intenta insertar un nuevo registro de cuestionario en la base de datos.
     * @param Cuestionario $cuestionario Cuestionario a insertar.
     * @return String Mensaje de error o de exito segun sea el caso.
     */
    public function crearCuestionario(Cuestionario $cuestionario)
    {
        if ($this->conectar()) {
            $sql = "INSERT INTO cuestionario(titulo, descripcion, tipo, idUsuario) VALUES(?, ?, ?, ?)";
            $consulta = $this->conexion->prepare($sql);

            $t = $cuestionario->getTitulo();
            $d = $cuestionario->getDescripcion();
            $tt = $cuestionario->getTipo();
            $i = $cuestionario->getIdUsuario();
            $consulta->bind_param('sssi', $t, $d, $tt, $i);

            if ($consulta->execute()) {
                return 'Cuestionario registrado con exito.';
            }

            return  'Ocurrió un error al ejecutar la consulta.';
        }

        return 'Ocurrió un error con la conexión a la base de datos.';
    }

    /**
     * Obtenemos los cuestionarios del profesor.
     * @return Array Cuestionarios.
     * @return String Mensaje de error.
     */
    public function getCuestionarios()
    {
        if ($this->conectar()) {
            $sql = "SELECT * FROM cuestionario WHERE idUsuario = ?";
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('i', $this->id);

            if ($consulta->execute()) {
                return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
            }

            return  'Ocurrió un error al ejecutar la consulta.';
        }

        return 'Ocurrió un error con la conexión a la base de datos.';
    }

    /**
     * Función que permite obtener el id, nombre y correo del profesor que imparte una clase específica
     * Recibe el id de la clase impartida por el profesor
     */
    public function getId_Nombre_Correo($idClase)
    {
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        if (!$conexion->connect_errno) {
            $consulta = $conexion->prepare('SELECT usuario.idUsuario AS idProfesor, usuario.nombre as profesor, correo FROM usuario
                                            INNER JOIN clase ON clase.idUsuario = usuario.idUsuario
                                            WHERE clase.idClase = ?');
            $consulta->bind_param('i', $idClase);
            $consultaRealizada = $consulta->execute();

            if ($consultaRealizada) {
                return $consulta->get_result()->fetch_row();
            }

            return false;
        }
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
