<?php

class CeldaColor{    
    
    private static function estilo($param, string $tipoMetrica=null, $clase=false){    
        $estilo = "style='color:" . $param['valor'] . "; background-color: " . $param['background-color'] . "'}";
        return $clase === false ? $estilo : "class='" . $tipoMetrica . "-" . $param['style'] . "'";
    }

    private static function evalRango(int $valor, int $desde, int $hasta){        
        $result = ($valor >= $desde) && ($valor <= $hasta) ? true : false;
        return $result;
    }
        
    /**
     * colorear
     *
     * @param  string $tipoMetrica nombre del tipo de métrica que está definida en el archivo json de configuración
     * @param  mixed $valor
     * @param  mixed $regla
     * @param  mixed $clase
     * @return void
     */
    static function colorear(string $tipoMetrica, int $valor, array $regla, $clase=false){
        $param = $regla[$tipoMetrica];
        foreach ($param as $ind => $rango)  {            
            if (self::evalRango($valor, intval($rango['desde']), intval($rango['hasta']))){                                
                return $clase === false ? self::estilo($rango) : self::estilo($rango, $tipoMetrica, $clase);
            }
        }
    }
}

