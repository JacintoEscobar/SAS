<?php

include_once '../modelos/BD.php';

class Etiqueta extends BD
{
    private string $id;
    private string $nombre;

    public function __construct(string $id = '', string $nombre = '')
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    /**
     * Inserta un nuevo registro de etiqueta.
     * @return bool Devuélve true si se insertó de manera correcta el nuevo registro o false en caso contrario o error.
     */
    public function insertar()
    {
        try {
            $this->conectar();
            $consulta = $this->conexion->prepare('INSERT INTO etiqueta VALUES(?, ?)');
            $consulta->bind_param('is', $this->id, $this->nombre);
            $consulta->execute();
            $insercionExitosa = $consulta->affected_rows > 0;
            $this->desconectar();
            return $insercionExitosa;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
