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
}
