<?php

include_once (__DIR__ . "./../../../config/constantes.php");
include_once (__DIR__ . "./../ranges/classRangos.php");
include_once (__DIR__ . "./../ranges/classStyle.php");
include_once (__DIR__ . "./../ranges/classEstiloRangoValor.php");

class Tabla {
        
    private int $filas;
    private int $columnas;
    private string $id;
    private string $class;
    private float $valorMenor;
    private float $valorMayor;
    private array $tableInfo;
    private string $rangesName;

    public function __construct(?array $tableParametros = null)
    {
        $this->setTableParam($tableParametros);        
    }

    public function setTableParam(?array $tableParam=null){
        if(!isset($tableParam)){
            $tableParam=[];
        }
        foreach(TABLE_DEFAULT as $ind => $value){
            if(!key_exists($ind, $tableParam)){
                $tableParam[$ind] = TABLE_DEFAULT[$ind];                
            }
        }        
        $this->tableInfo = $tableParam;
        $this->filas = $tableParam['filas'];
        $this->columnas = $tableParam['columnas'];
        $this->id = $tableParam['id'];
        $this->class = $tableParam['class'];
        $this->valorMenor = $tableParam['valorMenor'];
        $this->valorMayor = $tableParam['valorMayor'];     
        $this->rangesName = $tableParam['rangesName'];  
    }    

    public function setFilas(int $filas){
        $this->filas = $filas;
    }
    public function setColumnas(int $columnas){
        $this->columnas = $columnas;
    }
    public function setValorMenor(float $valorMenor){
        $this->valorMenor = $valorMenor;
    }
    public function setValorMayor(float $valorMayor){
        $this->valorMayor = $valorMayor;
    }
    public function setClass(string $class){
        $this->class = $class;
    }

    public function getTable():string {
        //$objRango = new Rangos();
        //$rangosInfo = $objRango->getRangeByName($this->rangesName);

        $table = "<table id='$this->id' class='$this->class'>\n";       
        $table = $table . "<thead>\n" ;
        $table = $table . "<th colspan='$this->columnas' class='tituloTabla'>Tabla de ejemplo</th>\n";
        $table = $table . "</thead>\n" ;
        $table = $table . "<tbody>\n";
        for ($contadorFila=1;  $contadorFila<=$this->filas; $contadorFila++){
            $table = $table . "<tr>\n";
            for ($contadorColumna=1; $contadorColumna<=$this->columnas; $contadorColumna++){                    
                $valor = random_int($this->valorMenor, $this->valorMayor);
                
                $rangoEspecifico=EstiloRangoValor::getEstiloData($this->rangesName, $valor);
                
                $estilo = Style::getStyle($rangoEspecifico);                
                $table = $table . "<td $estilo '> $valor </td>";
            }
            $table = $table . "</tr>\n";
        }        
        $table = $table . "</tbody>\n";
        $table = $table . "</table>\n";
        return $table;
    }

}

/*
$objTabla = new Tabla();
$tabla = $objTabla->getTable();
$a=5;
*/
?>