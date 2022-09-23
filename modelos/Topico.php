<?php

include_once '../modelos/BD.php';

class Topico
{
    private $id;
    private String $titulo;
    private String $descripcion;
    private String $idUA;

    function __construct($id = '', String $titulo, String $descripcion, String $idUA)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->idUA = $idUA;
    }

    // Métodos get
    public function getID()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getIDUA()
    {
        return $this->idUA;
    }
}
