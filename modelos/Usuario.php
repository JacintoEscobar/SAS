<?php

class Usuario
{
    private $id;
    private $usuario;
    private $contraseña;
    private $tipo;

    function __construct($usuario, $contraseña)
    {
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
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
