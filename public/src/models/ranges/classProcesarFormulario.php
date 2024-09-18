<?php

class ProcesarFormulario{

    
    private static function getDataFronRangosSet(array $rangosSet): array{
        
        $nuevoRangosSet = [
            "rangesName"=> $rangosSet['rangesName'], 
            "fechaCreacion" => $rangosSet['fechaCreacion'],
            "createdBy" => $rangosSet['createdBy'],
            "ranges" => $rangosSet['ranges']
        ];

        //$nuevoRangosSetJson = json_encode($nuevoRangosSet);

        //return $nuevoRangosSetJson;
        return $nuevoRangosSet;
    }

    static function guardarRangosSet(array $rangosSet){
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
                $conjuntoDeRangos[] = $nuevoRangoSet;
                $nuevoSuperSet = json_encode($conjuntoDeRangos);
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