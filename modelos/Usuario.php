<?php

include_once '../modelos/BD.php';

class Usuario extends BD
{
    private $id;
    private $usuario;
    private $contraseña;
    private $tipo;

    function __construct($usuario = null, $contraseña = null)
    {
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
    }

    /**
     * Realiza la consulta de actualización para un usuario.
     */
    public function actualizar($data)
    {
        try {
            $this->conectar();

            $sql = 'UPDATE usuario SET matricula = ?, nombre = ?, paterno = ?, materno = ?, correo = ?, usuario = ?, contraseña = ?, tipo = ? WHERE idUsuario = ?';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('ssssssssi', $data['matricula'], $data['nombre'], $data['paterno'], $data['materno'], $data['correo'], $this->usuario, $this->contraseña, $data['tipo'], $data['idUsuario']);

            $consulta->execute();

            return $consulta->affected_rows == 1;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Realiza la eliminacion de un usuario de la base de datos.
     * @return boolean
     */
    public function eliminarUsuario()
    {
        try {
            $this->conectar();

            $sql = 'DELETE FROM usuario WHERE idUsuario = ?';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bind_param('i', $this->id);

            $consulta->execute();

            if ($consulta->affected_rows == 1) {
                return true;
            }
            return false;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Actualiza el campo correo de la bd.
     * @param String $correo Nuevo correo.
     * @return String Mensaje de error o de éxito según el caso.
     */
    public function cambiarCorreo(String $correo)
    {
        // Realizamos la conexión a la bd y verificamos
        // que no haya ocurrido ningún error.
        if ($this->conectar()) {
            // Preparamos la consulta.
            $sql = "UPDATE usuario SET correo = ? WHERE idUsuario = ?";
            $consulta = $this->conexion->prepare($sql);

            // Asignamos los parámetros de consulta.
            $consulta->bind_param('si', $correo, $this->id);

            // Ejecutamos la consulta.
            // Verificamos que no haya ocurrido algún error.
            if ($consulta->execute()) {

                if ($consulta->affected_rows > 0) {
                    return 'Se actualizó correctamente tu correo.';
                }

                return 'Ocurrió un error al actualizar la base de datos.';
            }

            return  'Ocurrió un error al ejecutar la consulta.';
        }

        return 'Ocurrió un error con la conexión a la base de datos.';
    }

    /**
     * Actualiza el campo usuario de la bd.
     * @param String $usuario Nuevo usuario.
     * @return String Mensaje de error o de éxito según el caso.
     */
    public function cambiarUsuario(String $usuario)
    {
        // Realizamos la conexión a la bd y verificamos
        // que no haya ocurrido ningún error.
        if ($this->conectar()) {
            // Preparamos la consulta.
            $sql = "UPDATE usuario SET usuario = ? WHERE idUsuario = ?";
            $consulta = $this->conexion->prepare($sql);

            // Asignamos los parámetros de consulta.
            $consulta->bind_param('si', $usuario, $this->id);

            // Ejecutamos la consulta.
            // Verificamos que no haya ocurrido algún error.
            if ($consulta->execute()) {

                if ($consulta->affected_rows > 0) {
                    return 'Se actualizó correctamente tu usuario.';
                }

                return 'Ocurrió un error al actualizar la base de datos.';
            }

            return  'Ocurrió un error al ejecutar la consulta.';
        }

        return 'Ocurrió un error con la conexión a la base de datos.';
    }

    /**
     * Realiza una actualización a la bd. con el nuevo valor de una credencial del usuario.
     * @param String $tipo La credencial que se actualizará: usuario o contraseña.
     * @param String $credencial Nuevo valor de la credencial.
     * @param String $id id del usuario.
     */
    public function actualizarCredencial(String $tipo, String $credencial, String $id)
    {
        // Realizamos la conexión a la bd y verificamos
        // que no haya ocurrido ningún error.
        if ($this->conectar()) {
            // Preparamos la consulta.
            $sql = "UPDATE usuario SET " . $tipo . " = ? WHERE idUsuario = ?";
            $consulta = $this->conexion->prepare($sql);

            // Asignamos los parámetros de consulta.
            $consulta->bind_param('si', $credencial, $id);

            // Ejecutamos la consulta.
            // Verificamos que no haya ocurrido algún error.
            if ($consulta->execute()) {

                if ($consulta->affected_rows > 0) {
                    return 'Se actualizó correctamente tu ' . $tipo . '.';
                }

                return 'Ocurrió un error al actualizar la base de datos.';
            }

            return  'Ocurrió un error al ejecutar la consulta.';
        }

        return 'Ocurrió un error con la conexión a la base de datos.';
    }

    /**
     * Realiza la consulta del registro que coincida con el correo proporcionado.
     * @param String $correo Correo del usuario.
     * @return String|int id del usuario. Mensaje de error ocurrido.
     */
    public function verificarCorreo(String $correo)
    {
        // Realizamos la conexión a la bd y verificamos
        // que no haya ocurrido ningún error.
        if ($this->conectar()) {
            // Preparamos la consulta.
            $sql = 'SELECT idUsuario FROM usuario WHERE correo IN(?)';
            $consulta = $this->conexion->prepare($sql);

            // Asignamos los parámetros de consulta.
            $consulta->bind_param('s', $correo);

            // Ejecutamos la consulta.
            // Verificamos que no haya ocurrido algún error.
            if ($consulta->execute()) {

                $resultado = $consulta->get_result();
                if ($resultado->num_rows == 1) {
                    return $resultado->fetch_column(0);
                }

                return 'Ingrese un correo válido.';
            }

            return  'Ocurrió un error al ejecutar la consulta.';
        }

        return 'Ocurrió un error con la conexión a la base de datos.';
    }

    public function verificarUsuario()
    {
        //Creamos una conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "sas");

        //Verificamos que no haya ocurrido ningún error de conexión
        if (!$conexion->connect_errno) {
            // Preparamos la sentencia sql.
            $sentencia = $conexion->prepare('SELECT idUsuario AS id, usuario, tipo FROM usuario WHERE usuario = ? AND contraseña = ?');

            // Asignamos los parámetros de la consulta
            $this->contraseña = md5($this->contraseña);
            $sentencia->bind_param('ss', $this->usuario, $this->contraseña);

            // Ejecutamos la consulta
            $sentencia->execute();

            // Obtenemos los registros de la consulta
            $registros = $sentencia->get_result();

            // Obtenemos el primer registro (En este caso solo debe haber uno)
            $usuario = $registros->fetch_assoc();

            // Cerramos la conexión con la base de datos
            $conexion->close();

            // Devolvemos el arreglo con los valors obtenidos del registro solicitado en la consulta sql
            return $usuario;
        } else {
            return array('ERROR_DE_CONEXION' => 'Ocurrió un error al realizar la conexión con la base de datos.');
        }
    }

    public function cambiarContraseña($contraseñaNueva)
    {
        //Creamos una conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "sas");

        //Verificamos que no haya ocurrido ningún error de conexión
        if (!$conexion->connect_errno) {
            // Preparamos la sentencia sql.
            $sentencia = $conexion->prepare('UPDATE usuario SET contraseña = md5(?) WHERE usuario = ? AND contraseña = md5(?)');

            // Asignamos los parámetros de la consulta
            $sentencia->bind_param('sss', $contraseñaNueva, $this->usuario, $this->contraseña);

            // Ejecutamos la consulta
            $resultadoConsulta = $sentencia->execute();

            //Obtenemos el número de filas afectadas (debería ser 1 única fila afectada)
            $registrosAfectados = $conexion->affected_rows;

            // Cerramos la conexión con la base de datos
            $conexion->close();

            // Devolvemos el arreglo con los valors obtenidos del registro solicitado en la consulta sql
            if ($resultadoConsulta) {
                if ($registrosAfectados == 0) {
                    return array('CONTRASEÑA_ACTUAL_ERRONEA' => 'Verifique la contraseña actual ingresada');
                } else {
                    return 'CONTRASEÑA_ACTUALIZADA';
                }
            }
            return array('ERROR_ACTUALIZACION' => $conexion->error);
        } else {
            return array('ERROR_DE_CONEXION' => 'Ocurrió un error al realizar la conexión con la base de datos.');
        }
    }

    public function setID($id)
    {
        $this->id = $id;
    }
}
