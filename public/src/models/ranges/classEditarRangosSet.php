
<?php

class EditarRangosSet{

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

    public static function getRangoSet(int $id): array{
        $rangosSet = self::getRangosSet();
        if(array_key_exists($id, $rangosSet) ){
            return $rangosSet[$id];
        }else{
            return [];
        }
    }

    public static function getLeyendasHtml(array $ranges):string{
        $rangesHtml="";
        
        foreach($ranges as $id=>$range){
            $fondo = $range['backgroundColor'];
            $color = $range['color'];
            $contenido = $range['contenido'];
            $rangesHtml .= "<div class='leyenda'>";
            $rangesHtml .= "<div draggable='true' style='background-color:$fondo; color:$color;' data-id-leyenda='$id'>$contenido</div>";
            $rangesHtml .= "</div>\n";
        }

        return $rangesHtml;
    }

    public static function getListaDeLeyenda(int $id):string{
        $listaDeLeyendas = "";
        $rangosSet = self::getRangoSet($id);
        $ranges = $rangosSet['ranges'];
        $listaDeLeyendas = json_encode($ranges);
        return $listaDeLeyendas;
    }

}

