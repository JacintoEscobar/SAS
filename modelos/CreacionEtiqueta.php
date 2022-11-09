<?php

include_once '../modelos/BD.php';

class CreacionEtiqueta extends BD
{
    private string $idE;
    private string $idU;

    public function __construct(string $idE = '', string $idU = '')
    {
        $this->idE = $idE;
        $this->idU = $idU;
    }

    public function insertar()
    {
        try {
            $this->conectar();
            $consulta = $this->conexion->prepare('INSERT INTO creacionetiqueta(idEtiqueta, idUsuario) VALUES(?, ?)');
            $consulta->bind_param('is', $this->idE, $this->idU);
            $consulta->execute();
            $insercionExitosa = $consulta->affected_rows > 0;
            $this->desconectar();
            return $insercionExitosa;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
