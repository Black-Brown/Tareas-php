<?php

class plantilla {

    private static $instancia = null;


    public static function aplicar(){
        if(self::$instancia === null){
            self::$instancia = new plantilla();
        }
    }

    public function __construct(){

    }

    public function __destruct(){
        
    }
}

