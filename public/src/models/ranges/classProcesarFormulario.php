<?php

class ProcesarFormulario{

    
    private static function getDataFronRangosSet(array $rangosSet): array{
        
        $nuevoRangosSet = [
            "rangesName"=> trim($rangosSet['rangesName']), 
            "fechaCreacion" => $rangosSet['fechaCreacion'],
            "createdBy" => trim($rangosSet['createdBy']),
            "ranges" => $rangosSet['ranges']
        ];

        //$nuevoRangosSetJson = json_encode($nuevoRangosSet);

        //return $nuevoRangosSetJson;
        return $nuevoRangosSet;
    }

    static function guardarRangosSet(array $rangosSet, int $indice){
        try{

            $fileDir = __DIR__ . "./../../../../storageFiles/celdaColorRanges.json";

            $file = file_get_contents($fileDir);
            
            if($file===false){
                throw new Exception("no es posible acceder al conjunto de rangos");
            }elseif($file===""){
                $conjuntoDeRangos = [];
            }else{
                $conjuntoDeRangos = json_decode($file, true);                
            }
            
            if(isset($conjuntoDeRangos) && is_array($conjuntoDeRangos)){
                $nuevoRangoSet = self::getDataFronRangosSet($rangosSet);
                if ($indice == -1){
                    $indice = time();                    
                }
                $conjuntoDeRangos[$indice] = $nuevoRangoSet;                
                $nuevoSuperSet = json_encode($conjuntoDeRangos, JSON_PRETTY_PRINT);
                $bytes = file_put_contents($fileDir, $nuevoSuperSet);
                if(!$bytes){
                    throw new Exception("no se pudo almacenar la información en el archivo de conjuntos de rango");
                }
                return true;
            }else{
                throw new Exception("hay un error en la información de los conjuntos de rangos");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>