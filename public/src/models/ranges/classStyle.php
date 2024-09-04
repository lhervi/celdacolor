<?php

  class Style {

    static function getStyle(array $styleInfo){
        
        $backgroundcolor = $styleInfo['background-color'];
        $color = $styleInfo['color'];
        $style ="style ='background-color: $backgroundcolor; color: $color;"; 
        return $style;
    }

  }

?>