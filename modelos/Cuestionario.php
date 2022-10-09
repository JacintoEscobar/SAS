<?php

class Cuestionario
{
    private String $id;
    private String $titulo;
    private String $descripcion;
    private String $tipo;
    private String $idUsuario;

    function __construct(String $id = '', String $titulo, String $descripcion, String $tipo, String $idUsuario)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->idUsuario = $idUsuario;
    }

    // Metodos SET.
    public function setID(String $id) { $this->id = $id; }

    // Metodos GET.
    public function getID() { return $this->id; }

    public function getTitulo() { return $this->titulo; }

    public function getDescripcion() { return $this->descripcion; }

    public function getTipo() { return $this->tipo; }

    public function getIdUsuario() { return $this->idUsuario; }
}
