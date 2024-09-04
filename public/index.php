<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Prueba</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>      
        <script src="./js/jquery.table2excel.js"></script>
         
        
        <link rel="stylesheet" href="./css/style.css">        
        
    </head>    
    <body>      
    <div class="tableEjemplo">
        <?php
            include_once "./src/models/ranges/classRango.php";
            include_once "./src/models/ranges/classRangos.php";
            include_once "./../config/constantes.php";
            include_once "./src/models/tabla/classTabla.php";

            $tablaParam = ["rangesName"=>"semaforo", "valorMenor"=>0, "valorMayor"=>20, "filas"=>10, "columnas"=>20];
            $objTable = new Tabla($tablaParam);
            
            echo $objTable->getTable();

            echo "<br/><br/>";           
            
        ?>
        
        <button id="btnExport">Exportar a Excel</button>
    </div>
        
        
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


