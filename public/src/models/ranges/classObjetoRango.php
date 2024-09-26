<?php

include_once "./classRango.php";

class ObjetoRango{

    private string $rangesName;
    private string $fechaCreacion;
    private string $createdBy;
    private array $ranges;
    

    function __construct(array $objRangoInfo)
    {
        $this->setObjetoRangoInfo($objRangoInfo);        
    }

    function getRangesName():string{
        return $this->rangesName;
    }

    function getFechaCreacion():string{
        return $this->fechaCreacion;
    }
    function getCreatedBy():string{
        return $this->createdBy;
    }
    function getRanges():array{
        return $this->ranges;
    }

    function getObjetoRangoInfo (): array{
        $objRangoInfo=[
            "rangesName" => $this->rangesName,
            "fechaCreacion" => $this->fechaCreacion,
            "createdBy" => $this->createdBy,
            "ranges" => $this->ranges
        ];
        return $objRangoInfo;
    }

    function getObjetoRangoInfoJson (): string{
        $objRangoInfo = $this->getObjetoRangoInfo();
        $objRangoInfoJson = json_encode($objRangoInfo);
        return $objRangoInfoJson;
    }

    function setObjetoRangoInfo(array $objRangoInfo):void{
        $this->rangesName = $objRangoInfo['rangesName'];
        $this->fechaCreacion = $objRangoInfo['fechaCreacion'];
        $this->createdBy = $objRangoInfo['createdBy'];
        $this->ranges = $objRangoInfo['ranges'];
    }

    function setObjetoRangoInfoFromJson(string $objRangoInfoJson):void{
        $objRangoInfo = json_decode($objRangoInfoJson, true);
        $this->rangesName = $objRangoInfo['rangesName'];
        $this->fechaCreacion = $objRangoInfo['fechaCreacion'];
        $this->createdBy = $objRangoInfo['createdBy'];
        $this->ranges = $objRangoInfo['ranges'];
    }
    
}

?>