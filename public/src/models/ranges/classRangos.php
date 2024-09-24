<?php

include_once (__DIR__ . "./../../../../config/constantes.php");

class Rangos{

    private array $ranges;
    private array $indicesRangos;    
    
    
    public function __construct(?array $ranges=null)
    {        
        
        if(isset($ranges)){
            $this->ranges = $ranges;
        }else{
            $file = CELDA_COLOR_RANGES;
            try{
                if(!$file){
                    throw new Exception("No se puede abrir el archivo");
                }
                $rangesJson = file_get_contents($file);
                $rangesProvisional = json_decode($rangesJson, 1);
                $this->ranges = $rangesProvisional;
            }catch(Exception $e){
                echo 'Excepcion capturada: ', $e->getMessage(), "\n";
            }            
        }     
        $this->getRangosIndices();   
    }

    function addRange(Rango $range){        
        $this->ranges[] = $range;
    }

    function deleteRange(int $indice){
        unset($this->range[$indice]);
    }

    function getRangosJson(){
        return json_encode($this->ranges, JSON_PRETTY_PRINT);
    }

    function getRangos(){
        return $this->ranges;
    }

    function setRangos(array $ranges){
        $this->ranges = $ranges;
    }

    function storeRanges(){
        $jsonRanges = $this->getRangosJson();
        file_put_contents(RANGES_NAME, $jsonRanges);
    }   

    function getRangosIndices(): array{        
        foreach($this->ranges as $ind=>$range){            
            $this->indicesRangos[$ind] = $range['rangesName'];            
        }
        return $this->indicesRangos;
    }

    function getRangeByIndice(int $indice): array{
        if (key_exists($indice, $this->indicesRangos)){
            return $this->ranges[$indice];
        }else{
            return [];
        }        
    }

    function getRangeIndiceNumber(string $rangoName): int{
        $pos =0;
        if (in_array($rangoName, $this->indicesRangos)){
            $pos = array_search($rangoName, $this->indicesRangos);
        }
        return $pos;        
    }

    function getRangeByName(string $rangoName): array{
        $pos = $this->getRangeIndiceNumber($rangoName);
        return $this->getRangeByIndice($pos);
    }

    function getRangosOptions(): string{
        $htmlRangoOpiones="";
        foreach($this->indicesRangos as $ind=>$rangoName){
            //$htmlRangoOpiones = $htmlRangoOpiones . "<option value=$rangoName>$rangoName</option> \n";
            $htmlRangoOpiones = $htmlRangoOpiones . "<option value=$rangoName>$rangoName</option> \n";
        }
        return $htmlRangoOpiones;
    }


}


    //------ Solo para pruebas de esta clase

    /*

        $objRangos = new Rangos();
        $opt = $objRangos->getRangosOptions();

        //$rangosArray = $objRangos->getRangos();
        //$rangosIndices = $objRangos->getRangosIndices();
        //$range1 = $objRangos->getRangeByIndice(1);
        //$range2 = $objRangos->getRangeIndiceNumber('semaforo2');
        //$range3 = $objRangos->getRangeByName('semaforo2');
        //$rangosJson = $objRangos->getRangosJson();

        $a=5;

    */

?>