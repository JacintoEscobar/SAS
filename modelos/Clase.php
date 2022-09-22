<?php

include_once '../modelos/BD.php';

class Clase extends BD
{
    private $id;
    private $nombre;
    private $descripcion;
    private $cuatrimestre;
    private $grupo;
    private $carrera;
    private $codigo;

    function __construct($codigo = null, $id = null)
    {
        $this->codigo = $codigo;
        $this->id = $id;
    }

    /**
     * Realiza la consulta de inserción a la bd para dar de al una nueva ua.
     * @param $ua Unidad de aprendizaje que se dará de alta en el sistema.
     * @return string|number Devuelve el mensaje del error ocurrido o el número de filas afectas en la bd. 
     */
    public function addUA(UnidadAprendizaje $ua)
    {
        // Realizamos la conexión con la base de datos.
        if ($this->conectar()) {
            try {
                // Preparamos la consulta sql.
                $sql = 'INSERT INTO unidadaprendizaje(titulo, descripcion, idClase) VALUES(?, ?, ?)';
                $consulta = $this->conexion->prepare($sql);

                // Asignamos los parámetros de consulta.
                $titulo = $ua->getTitulo();
                $descripcion = $ua->getDescripcion();
                $idClase = $this->id;
                $consulta->bind_param('ssi', $titulo, $descripcion, $idClase);

                /**
                 * Ejecutamos la consulta sql y verificamos
                 * que estase haya realizado correctamente
                 */
                if ($consulta->execute()) {
                    return $consulta->affected_rows;
                }

                return 'ERROR_SQL';
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
        }

        return 'ERROR_DE_CONEXIÓN';
    }

    /**
     * Obtiene de la bd las unidades de aprendizaje.
     * @return String|mixed Retorna el mensaje del error que haya ocurrido o las ua como un arreglo asociativo
     */
    public function getUA()
    {
        // Realizamos la conexión con la base de datos.
        if ($this->conectar()) {
            try {
                // Preparamos la consulta sql.
                $sql = 'SELECT * FROM unidadaprendizaje WHERE idClase = ?';
                $consulta = $this->conexion->prepare($sql);

                // Asignamos los parámetros de consulta.
                $consulta->bind_param('i', $this->id);

                /**
                 * Ejecutamos la consulta sql y verificamos que esta
                 * se haya realizado correctamente para obtener
                 * los registros de las ua.
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
