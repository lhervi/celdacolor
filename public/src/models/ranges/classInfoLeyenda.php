<?php 

class InfoLeyenda{
    private static function getLeyendasSet(string $nombreRangoSet):array{
        $leyendaSet=[];

        try{

            $file = __DIR__ .  "./../../../../storageFiles/celdaColorRanges.json";
            
            if($file){
                $rangesSets = json_decode(file_get_contents($file),true);
            }else{
                throw new Exception("el archivo del conjunto de rangos no se encontró en la ruta");
            }

            if(isset($rangesSets) && is_array($rangesSets) && count($rangesSets)> 0){         

                foreach($rangesSets as $rangeSet){
                    if(isset($rangeSet["rangesName"]) && strtolower($rangeSet["rangesName"])==strtolower($nombreRangoSet)){
                        $leyendaSet =  $rangeSet["ranges"];
                        break;
                    }
                }
            }else{
                throw new Exception("no hay información en el archivo del conjunto de rangos");
            }

        }catch(Exception $e){            
            echo $e->getMessage();         
        }
        return $leyendaSet;
    }

    private static function getHtmlLeyenda(array $leyenda):string{
        $background = $leyenda["backgroundColor"];
        $color = $leyenda["color"];
        $contenido = $leyenda["contenido"];
        $htmlLeyenda="<div class='leyendaInfo' style='background-color:$background; color:$color;'>$contenido</div>\n";
        return $htmlLeyenda;
    }

    static function getHtmlLeyendas(string $nombreLeyendaSet): string{
        
        $leyendas = "";

        $leyendasSet = self::getLeyendasSet($nombreLeyendaSet);

        if(isset($leyendasSet) && count($leyendasSet)>0){
            
            foreach($leyendasSet as $leyenda){
                $leyendas = $leyendas . self::getHtmlLeyenda($leyenda);
            }
        }
        return $leyendas;
    }

    

}

/*
$rangoName ="semaforo7";

$leyendas = InfoLeyenda::getHtmlLeyendas($rangoName);

$a=5;   

*/

?>