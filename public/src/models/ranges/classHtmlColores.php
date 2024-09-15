<?php

class HtmlColores {
    

    private static function getFileColores():string{
        try{
            $file = file_get_contents (__DIR__ . "./../../../../storageFiles/listaColores.json");
            
            if($file){
                return $file;
            }else{
                throw new Exception("no se puede acceder al archivo de colores");
            }
            
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    static public function getColoresJson():string{
        return self::getFileColores();
    }

    private static function getTextoColor(string $color):string{
        $hex = str_replace('#', '', $color);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $luminosidad = (0.2126 * $r) + (0.7152 * $g) + (0.0722 * $b);

        $textColor = "#FFFFFF";
        
        if($luminosidad > 128){
            $textColor = "#000000";
        }

        return $textColor;

    }

    static public function getOpcionesSelectDeColores(){
        $file = self::getFileColores();
        try{
            $listaColores = json_decode($file, true);
            if($listaColores){
                $opciones = "";
                foreach($listaColores as $ind => $datoColor){        
                    $textColor = self::getTextoColor($datoColor['codigo']);
                    $estilo = 'style="color:' . $textColor . '; background-color:' . $datoColor['codigo'] . ';"';
                    $opciones = $opciones . "<option value='" . $datoColor['codigo'] . "' data-color='" . $datoColor['color'] . "' $estilo>";
                    //$opciones = $opciones . "■ " . $datoColor['color'];
                    $opciones = $opciones . $datoColor['color'];
                    $opciones = $opciones . "</option>\n";
                }
                return $opciones;
            }else{
                throw new Exception("no se puede leer el archivo de colores");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

//prueba

/*
    $p = HtmlColores::getOpcionesSelectDeColores();
    $a=5;

*/

?>