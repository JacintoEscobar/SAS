<?php

include_once '../modelos/BD.php';

class Asignacion extends BD
{

    private string $idAsignacion;
    private string $fechaAsignacion;
    private string $fechaCierre;
    private string $idCuestionario;
    private string $idClase;

    public function __construct(string $idA = '', string $fA, string $fC, string $idCu, string $idCl)
    {
        $this->idAsignacion = $idA;
        $this->fechaAsignacion = $fA;
        $this->fechaCierre = $fC;
        $this->idCuestionario = $idCu;
        $this->idClase = $idCl;
    }

    /**
     * Realiza la consulta de inserción.
     */
    public function insertar()
    {
        try {
            $this->conectar();

            $consulta = $this->conexion->prepare('INSERT INTO asignacion(fechaAsignacion, fechaCierre, idCuestionario, idClase) VALUES(?, ?, ?, ?)');

            $consulta->bind_param('ssii', $this->fechaAsignacion, $this->fechaCierre, $this->idCuestionario, $this->idClase);

            $consulta->execute();

            return $consulta->affected_rows > 0;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
