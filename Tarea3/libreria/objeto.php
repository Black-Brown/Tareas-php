<?php

class Personajes {

    public $idx = '';
    public $nombre = '';
    public $apellido = '';
    public $fecha_nacimiento = '';
    public $foto = '';
    public $profesion = '';
    public $nivel_experiencia = '';

    public function __construct($data = []) {
        if (is_object($data)){
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}


class Profesiones {
    
    public $idx = '';
    public $codigo = '';
    public $nombre_profesion = '';
    public $categoria = '';
    public $salario_mensual = 0;

    function __construct($data = []) {
        if (is_object($data)){
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

class Datos {

    public static function nivel_experiencia() {
        return [
            'Principiante' => 'Principiante',
            'Intermedio' => 'Intermedio',
            'Avanzado' => 'Avanzado',
            'Experto' => 'Experto',
        ];
    }
}
