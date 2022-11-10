<?php

include_once '../modelos/BD.php';

class MaterialEducativo extends BD
{
    private string $titulo;
    private string $direccion;
    private string $idTopico;
    private string $idEtiqueta;
    private string $tipo;

    public function __construct(string $ti = '', string $d = '', string $idT = '', string $idE = '', $t = '')
    {
        $this->titulo = $ti;
        $this->direccion = $d;
        $this->idTopico = $idT;
        $this->idEtiqueta = $idE;
        $this->tipo = $t;
    }

    public function insertar()
    {
        try {
            $this->conectar();
            $consulta = $this->conexion->prepare('INSERT INTO materialeducativo(titulo, direccion, idTopico, idEtiqueta, tipo) VALUES(?, ?, ?, ?, ?)');
            $consulta->bind_param('ssiis', $this->titulo, $this->direccion, $this->idTopico, $this->idEtiqueta, $this->tipo);
            $consulta->execute();
            $insercion_correcta = $consulta->affected_rows > 0;
            $this->conexion->close();
            return $insercion_correcta;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function eliminar(string $idME)
    {
        try {
            $this->conectar();
            $consulta = $this->conexion->prepare('DELETE FROM materialeducativo WHERE idMaterialEducativo = ?');
            $consulta->bind_param('i', $idME);
            $consulta->execute();
            $eliminacion_correcta = $consulta->affected_rows > 0;
            $this->conexion->close();
            return $eliminacion_correcta;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getMaterial(string $ti = '', string $d = '', string $idT = '', string $idE = '', $t = '')
    {
        try {
            $con = new mysqli('localhost', 'root', '', 'sas');
            $consulta = $con->prepare(
                'SELECT idMaterialEducativo
                 FROM materialEducativo
                 WHERE titulo = ? AND direccion = ? AND idTopico = ? AND idEtiqueta = ? AND tipo = ?'
            );
            $consulta->bind_param('ssiis', $ti, $d, $idT, $idE, $t);
            $consulta->execute();
            $id = $consulta->get_result()->fetch_column(0);
            $con->close();
            return $id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
