<?php

class paciente {

    public $codigo;
    public $nombre;
    public $apellido;
    public $cedula;
    public $edad;
    public $motivo;
    public $fecha_hora;

    public function __construct($codigo, $nombre, $apellido, $cedula, $edad, $motivo){
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->edad = $edad;
        $this->motivo = $motivo;
        $this->fecha_hora = date("F j, Y, g:i a");
    }
}