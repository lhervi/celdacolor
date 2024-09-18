<?php

class Rango{
    private float $left;
    private bool $leftOpen;
    private float $right;
    private bool $rightOpen;
    private string $colorName;
    private string $color;
    private string $backgroundColorName;
    private string $backgroundColor;

    
    function __construct(array $config)
    {
        $this->left = $config['left'];
        $this->right = $config['right'];
        $this->leftOpen = $config['leftOpen'];
        $this->rightOpen = $config['rightOpen']; 
        $this->colorName =$config['colorName']; 
        $this->color =$config['color']; 
        $this->backgroundColorName = $config['backgroundColorName'];
        $this->backgroundColor = $config['backgroundColor'];
    }

    function setConfig(array $config){
        
        $this->left = $config['left'];
        $this->right = $config['right'];
        $this->leftOpen = $config['leftOpen'];
        $this->rightOpen = $config['rightOpen']; 
        $this->colorName =$config['colorName']; 
        $this->color =$config['color']; 
        $this->backgroundColorName = $config['backgroundColorName'];
        $this->backgroundColor = $config['backgroundColor'];
    }

    function getConfig():array{
        $config=[
            "left" => $this->left,
            "right" => $this->right,
            "leftOpen" => $this->leftOpen,
            "rightOpen" => $this->rightOpen,
            "colorName"=> $this->colorName,
            "color" => $this->color,
            "backgroundColorName" => $this->backgroundColorName,
            "backgroundColor" => $this->backgroundColor
        ];

        return $config;        
    }

    function getConfigJson(){
        $configJson = json_encode($this->getConfig());
        return $configJson;
    }

    public function getLeft(): float {
        return $this->left;
    }

    public function getRight(): float {
        return $this->right;
    }

    public function isLeftOpen(): bool {
        return $this->leftOpen;
    }

    public function isRightOpen(): bool {
        return $this->rightOpen;
    }

    public function getColorName(): string {
        return $this->colorName;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function getBackgroundColorName(): string {
        return $this->backgroundColorName;
    }

    public function getBackgroundColor(): string {
        return $this->backgroundColor;
    } 
    
}

/* 
//Prueba


        $rangoConfig = [
            "left" => 0,
            "right" => 5,
            "leftOpen" => false,
            "rightOpen" => true,
            "colorName" => "blanco",
            "color" => "#ffffff",
            "backgroundColorName" => "negro",
            "backgroundColor" => "#000000"
        ];

        $rango = new Rango($rangoConfig);

        $prueba = $rango->getConfigJson();

        $a=5;
*/


?>