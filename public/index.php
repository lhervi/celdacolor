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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
        
        <link rel="stylesheet" href="./css/style.css">        
        
    </head>    
    <body>      

    <div class="container  mt-3">

    

    <?php include __DIR__ . '/src/views/components/menu.php'; ?>

    <div class="tableEjemplo">
        <?php
            include_once "./src/models/ranges/classRango.php";
            include_once "./src/models/ranges/classRangos.php";
            include_once "./../config/constantes.php";
            include_once "./src/models/tabla/classTabla.php";
            
            
            $rangoSeleccionado = RANGO_DEFAULT;

            if (isset($_POST['rangosList'])){
                $rangoSeleccionado = $_POST['rangosList'];
            }
            
            $tablaParam = ["rangesName"=>$rangoSeleccionado, "valorMenor"=>0, "valorMayor"=>100, "filas"=>5, "columnas"=>20];
            $objTable = new Tabla($tablaParam);

            $objRangos = new Rangos();
            
            echo $objTable->getTable();

            echo "<div id='semaforoActivo'><p><strong>semáforo activo: </strong> $rangoSeleccionado<p></div>";
            
        ?>

        <div class="forma">
            <form action="index.php" method="POST" >
                <label for="rangosList" >Elije un conjunto de Rangos</label>
                <select id="rangosList" name="rangosList">
                    <?php echo $objRangos->getRangosOptions() ?>
                </select>
                
                <div id="enviar">
                    <button type="submit">Aplicar</button>
                </div>

                <!-- ----------------------- Leyendas -------------------------------- -->

                <div id="leyendas" class="leyendaDeRangos">
                    
                </div>

                <!-- ----------------------- Leyendas -------------------------------- -->
            </form>
            <br/>
            <!--a href="./src/views/adminRangos.php">Aministrar Rangos</a-->
        </div>

    </div>

        <script>            

            function pintarLeyendas(rangoName){                

                const leyendasDiv = document.getElementById("leyendas");

                url="http://localhost/celdacolor/public/src/controllers/getLeyendas.php?nombreRangoLeyenda=" + rangoName;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.leyendas);
                        leyendasDiv.innerHTML = data.leyendas
                    }).catch(error => {
                        console.log(error);
                    });
            }

            function mostrarLeyenda(e){
                rangoName = e.target.value;
                pintarLeyendas(rangoName);
            }

            pintarLeyendas("<?php echo $rangoSeleccionado?>");
            
            rangosList = document.getElementById('rangosList');
            rangosList.addEventListener('input', mostrarLeyenda);

            
        </script>

    
       
    </body>
    </div>
</html>


