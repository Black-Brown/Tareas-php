<?php

class obra{

    public $codigo;
    public $foto_url;
    public $tipo;
    public $nombre;
    public $descripcion;
    public $pais;
    public $autor;

    public function __construct($codigo, $foto_url, $tipo, $nombre, $descripcion, $pais, $autor) {
        $this->codigo = $codigo;
        $this->foto_url = $foto_url;
        $this->tipo = $tipo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->pais = $pais;
        $this->autor = $autor;
    }
}

class personaje{

    public $cedula;
    public $foto_url;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $sexo;
    public $habilidades;
    public $comida_favorita;

    public function __construct($cedula, $foto_url, $nombre, $apellido, $fecha_nacimiento, $sexo, $habilidades, $comida_favorita) {
        $this->cedula = $cedula;
        $this->foto_url = $foto_url;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->sexo = $sexo;
        $this->habilidades = $habilidades;
        $this->comida_favorita = $comida_favorita;
    }
}

class Datos{

    public static function tipo_de_obra(){
        return [
            'Serie' => 'Serie',
            'Película' => 'Película',
            'Documental' => 'Documental',
            'Libro' => 'Libro'
        ];
    }

    public static function tipo_de_personaje(){
        return [
            'Femenino' => 'Femenino',
            'Masculino' => 'Masculino',
        ];
    }
    
    public static function signos_zodiacales() {
        return [
            'Aries' => 'Aries',
            'Tauro' => 'Tauro',
            'Géminis' => 'Géminis',
            'Cáncer' => 'Cáncer',
            'Leo' => 'Leo',
            'Virgo' => 'Virgo',
            'Libra' => 'Libra',
            'Escorpio' => 'Escorpio',
            'Sagitario' => 'Sagitario',
            'Capricornio' => 'Capricornio',
            'Acuario' => 'Acuario',
            'Piscis' => 'Piscis'
        ];
    }
}

?>