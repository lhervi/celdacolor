<?php

include_once __DIR__ . "./../ranges/classRangos.php";
include_once __DIR__ . "./../ranges/classObjetoRango.php";

class TableRangosCrud{
    
    private static function getFilaPrincipal(int $pos, ObjetoRango $objRango): string{
        $name = $objRango->getRangesName();
        $fecha = $objRango->getFechaCreacion();
        $autor = $objRango->getCreatedBy();
        $fila ="<table class='rangosSet'><thead>
                <tr>
                    <th  colspan='2'>Nombre del Rango</th><th>Fecha de creación</th><th colspan='2'>Creado por</th>            
                    <th rowspan='2' pos='$pos' class='edit' tipo='edit'>Editar</th><th rowspan='2' class='add' pos='$pos' tipo='add'>Añadir</th><th rowspan='2' pos='$pos' class='delete' tipo='delete'>Eliminar</th>
                </tr>
                <tr> 
                    <td  colspan='2'>$name</td><td>$fecha</td><td  colspan='2'>$autor</td>
                </tr>
                <tr>
                    <th>Límite</th><th>Desde</th><th>Hasta</th><th>Límite</th>
                    <th>Color de la letra</th><th>Etiqueta</th><th>Color del fondo</th><th>Etiqueta</th>
                </tr></thead>\n
        ";
        return $fila;                 
    }

    private static function getBody(array $ranges): string{

        $body = "<tbody>\n";

        foreach($ranges as $ind=> $range){

            $backGround = $range['backgroundColor'];
            $color = $range['color'];
            $left =  $range['left'];
            $right =  $range['right'];
            $limIzq = $range['leftSymbol'];
            $limDer = $range['rightSymbol'];
            $colorName = $range['colorName'];            
            $colorBackGroundName = $range['backgroundColorName'];

            $body = $body . 
                "
                    <tr>
                        <td>$limIzq</td><td>$left</td><td>$right</td><td>$limDer</td>
                        <td style='background-color:$backGround; color:$color;'><strong>$colorName</strong></td>                        
                        <td>
                            $colorName
                        </td>
                        <td style='background-color:$backGround; color:$color;'></td>                        
                        <td>
                            $colorBackGroundName 
                        </td>      
                    </tr>\n";
        }
        $body = $body . "</tbody>\n";
        return $body;
    }

    public static function getTableRangos():string{
        $tabla = "";
        $conjuntoDerangos = new Rangos();  
        $rangosarreglo = $conjuntoDerangos->getRangos();
        foreach($rangosarreglo as $pos => $rangos){
            $objRango = new ObjetoRango($rangos);            
            $tabla =  $tabla . self::getFilaPrincipal($pos, $objRango);
            $tabla =  $tabla . self::getBody($objRango->getRanges());    
            $tabla = $tabla . "</table> </br></br>";        
        }
        
        return $tabla; 
    }
       
}




?>