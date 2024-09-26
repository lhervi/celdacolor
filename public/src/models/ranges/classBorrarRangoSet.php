<?php

class BorrarRangoSet{
    
    static $fileDir = __DIR__ . "./../../../../storageFiles/celdaColorRanges.json";
    
    private static function getRangosSet():array{
        $rangosSet = [];
        try{

            $fileDir = self::$fileDir;
            if($fileDir){
                $file = file_get_contents($fileDir);
            }else{
                throw new Exception("no se puede acceder al archivo de los conjuntos de rangos");                
            }

            $rangosSet = json_decode($file,true);
            
            if(!isset($rangosSet)){
                throw new Exception("el archivo de conjunto de rangos no pudo ser leído");                                
            }

        }catch(Exception $e){            
            return [];
        }
        
        return $rangosSet;
    }
    
    public static function borrar(int $indice): bool{
        $rangosSet = self::getRangosSet();
        $fileDir = self::$fileDir;
        if(array_key_exists($indice, $rangosSet)){
            unset($rangosSet[$indice]);
            file_put_contents($fileDir, json_encode($rangosSet, JSON_PRETTY_PRINT));
            return true;
        }        
        return false;        
    }
}

?>