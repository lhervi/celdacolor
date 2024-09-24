<?php

include_once __DIR__ . "./../../../config/constantes.php";
include_once __DIR__ . ("./../ranges/classRangos.php");

class EstiloRangoValor{   
    
    
    public static function getEstiloData(?string $nombreRango=null, float $valor): array{

        $estilo = [];

        if(!isset($nombreRango)){
            $nombreRango = RANGO_DEFAULT;
        }
        $objRangos = new Rangos();
        $rangosData = $objRangos->getRangeByName($nombreRango);
        $estilo = self::getEstiloInfo($rangosData, $valor);
        return $estilo;
    }

    private static function getEstiloInfo(array $rangos, $valor): array{
        $styleData = [];
        
        foreach($rangos['ranges'] as $ind=>$parametros){
            $styleData = self::getRangoDataByValor($parametros, $valor);
            if (count($styleData)>0){
                break;
            }
        }
        return $styleData;
    }

    private static function getRangoDataByValor(array $parametros, $valor): array{
        
        $styleData = [];
        $estaEnElRangoMenor = ($parametros['leftOpen']=="true" && $valor > floatval($parametros['left']));
        $estaEnELRangoMenorIgual = ($parametros['leftOpen']=="false" && $valor >= floatval($parametros['left']));
        $estaEnElRangoMayor = ($parametros['rightOpen']=="true" && $valor < floatval($parametros['right']));
        $estaEnElRangoMayorIgual = ($parametros['rightOpen']=="false" && $valor <= floatval($parametros['right']));
        if($estaEnElRangoMenor || $estaEnELRangoMenorIgual){
            if($estaEnElRangoMayor || $estaEnElRangoMayorIgual){
                $styleData = [
                    "background-color" => $parametros['backgroundColor'],
                    "color" => $parametros['color'],
                    "colorName" => $parametros['colorName'],
                    "backgroundColorName" => $parametros['backgroundColorName'],
                    "left" => $parametros['left'],
                    "right" => $parametros['right'],
                    "rightOpen" => $parametros['rightOpen'],
                    "leftOpen" => $parametros['leftOpen'],                    
                ];                
            }
        }
        return $styleData;
    }

}
/*
    //prueba

    $nombreEstilo = "semaforo2";
    $prueba = EstiloRangoValor::getEstilo($nombreEstilo, 10);
    $a=5;

*/

?>