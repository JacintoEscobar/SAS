<?php

include_once '../modelos/BD.php';

class RegistroEtiqueta extends BD
{
    private string $id;
    private string $idE;
    private string $idU;

    public function __construct(string $id = '', string $idE = '', string $idU = '')
    {
        $this->id = $id;
        $this->idE = $idE;
        $this->idU = $idU;
    }

    /**
     * Inserta un nuevo registro de etiqueta en la bd.
     * @return bool true en caso de inserción correcta o false en caso contrario o en caso de error.
     */
    public function insertar()
    {
        try {
            $this->conectar();
            $sql = $this->conexion->prepare('INSERT INTO registroetiqueta(idEtiqueta, idUsuario) VALUES(?, ?)');
            $sql->bind_param('ii', $this->idE, $this->idU);
            $sql->execute();
            $insercionCorrecta = $sql->affected_rows;
            $this->desconectar();
            return $insercionCorrecta > 0;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
