<?php

define("DATA_DIR", __DIR__ . "/../data/");

if(!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0777, true);
}

class Dbx {

    public static function listar($colleccion) {
        $dataPath = DATA_DIR . "/{$colleccion}";

        if (!is_dir($dataPath)) {
            return [];
        }

        $files = scandir($dataPath);
        $data = [];

        foreach ($files as $file) {

            $filePath = $dataPath . '/' . $file;

            if (!is_file($filePath)) {
                continue;
                
            }
            if (is_file($filePath)) {
                $content = file_get_contents($filePath);
                $itemData = unserialize($content);

                if ($itemData) {
                    $data[] = $itemData;
                }
            }
        }
        return $data;
    }
    
    public static function obtener($colleccion, $codigo) {
        $dataPath = DATA_DIR . "/{$colleccion}/{$codigo}.dat";

        if (!file_exists($dataPath)) {
            return null;
        }

        $content = file_get_contents($dataPath);
        return unserialize($content);
    }



    public static function guardar($colleccion, $codigo, $objeto) {
        $dataPath = DATA_DIR . "/{$colleccion}";

        if (!is_dir(dirname($dataPath))) {
            mkdir(dirname($dataPath), 0777, true);
        }

        if (empty($codigo)) {
            $fileName = uniqid();
            $objeto->idx = $fileName;
        } else {
            $fileName = $codigo;
            $objeto->idx = $fileName;
        }

        $filePath = $dataPath . '/' . $fileName . '.dat';

        file_put_contents($filePath, serialize($objeto));
    }

}