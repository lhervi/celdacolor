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

$regla = json_decode(file_get_contents("paramRangoColor.json"), true);

$tipoMetrica1 = "tipoMetrica1";
$tipoMetrica2 = "tipoMetrica2";
$tipoMetrica3 = "tipoMetrica3";

?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Prueba</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>      
        <script src="src/jquery.table2excel.js"></script>
        

        <style>
            <?php
            foreach ($regla as $nom =>$est){
                foreach($est as $ind=>$caract){
                    $estilo = "." . $nom . "-" . $caract['style'] . " {color:" . $caract['valor'] . "; ";
                    $estilo.= "background-color:" . $caract['background-color'] . ";} ";                    
                    echo $estilo . PHP_EOL;
                }
            }
            ?>           

        </style>
        
    </head>    
    <body>
        <form id="formaMetrica" action="classCeldaColor.php" method="POST">
            <div>
                <input type="text" val ="0" name="cel1">
                <input type="text" val ="0" name="cel2">
                <input type="text" val ="0" name="cel3">
            </div>

            <div>
                <input type="submit">
            </div>
        </form>

        <table id="tablaMetrica" class="table2excel colorClass">
            <th colspan="3">Tabla de ejemplo</th>
            <tr>
            <?php
                $valor = random_int(0, 100);
                $estilo = CeldaColor::colorear($tipoMetrica1, $valor, $regla);
                echo "<td " . $estilo . "'>" . $valor . "</td>";
                $valor = random_int(0, 100);
                $estilo = CeldaColor::colorear($tipoMetrica1, $valor, $regla);
                echo "<td " . $estilo . "'>" . $valor . "</td>";
                $valor = random_int(0, 100);
                $estilo = CeldaColor::colorear($tipoMetrica1, $valor, $regla);
                echo "<td " . $estilo . "'>" . $valor . "</td>";                            
            ?>
            </tr>
            <tr>
            <?php
               $valor = random_int(0, 100);
               $estilo = CeldaColor::colorear($tipoMetrica2, $valor, $regla);
               echo "<td " . $estilo . "'>" . $valor . "</td>";
               $valor = random_int(0, 100);
               $estilo = CeldaColor::colorear($tipoMetrica2, $valor, $regla, true);
               echo "<td " . $estilo . "'>" . $valor . "</td>";
               $valor = random_int(0, 100);
               $estilo = CeldaColor::colorear($tipoMetrica2, $valor, $regla, true);
               echo "<td " . $estilo . "'>" . $valor . "</td>";             
            ?>
            </tr>
            <tr>
            <?php
               $valor = random_int(0, 100);
               $estilo = CeldaColor::colorear($tipoMetrica3, $valor, $regla, true);
               echo "<td " . $estilo . "'>" . $valor . "</td>";
               $valor = random_int(0, 100);
               $estilo = CeldaColor::colorear($tipoMetrica3, $valor, $regla, true);
               echo "<td " . $estilo . "'>" . $valor . "</td>";
               $valor = random_int(0, 100);
               $estilo = CeldaColor::colorear($tipoMetrica3, $valor, $regla, true);
               echo "<td " . $estilo . "'>" . $valor . "</td>";                
            ?>
            </tr>
        </table>   
        
        <button id="btnExport"">Exportar a Excel</button>
        
       

        <script>
            jQuery(function() {
                  
                jQuery("#btnExport").click(function(e){
                    alert("Aquí estoy 25");
                    var table = jQuery(this).prev('.table2excel');
                    if(table && table.length){
                        var preserveColors = (table.hasClass('colorClass') ? true : false);  
                        jQuery(table).table2excel({  
// This class's content is excluded from getting exported
                            exclude: ".noExl", 
                            name: "Datos en Excel",
                            filename: "outputFile-" + new Date().toString().replace(/[\-\:\.]/g, "") + ".xls",  
                            fileext: ".xls", //File extension type
                            exclude_img: true,
                            exclude_links: true,
                            exclude_inputs: true,
                            preserveColors: true
                        });
                    }
                });        
            });
        </script>
       
    </body>
</html>
<div>

