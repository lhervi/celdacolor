<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./../../css/style.css">
    <title>Editar Conjunto de Rangos</title>
</head>
<body>
    
    <div class="container mt-3">
    <?php 
        include __DIR__ . '/components/menu.php'; 
        include __DIR__ . "./../models/ranges/classEditarRangosSet.php";
        
        
        $indice = isset($_GET['indice']) ? intval($_GET['indice']) : -1;

        $rangoSet = EditarRangosSet::getRangoSet($indice);
        $leyendasHtml = EditarRangosSet::getLeyendasHtml($rangoSet['ranges']);
        $listaLeyenda = EditarRangosSet::getListaDeLeyenda($indice);

        $a=5;
    ?>
        <div class="formulario">

            <input id='listaRangos' type='text' hidden value=' <?php echo $listaLeyenda ?> '>

        
            <div><h1 class="mb-4">Formulario para editar un conjunto de Rangos</h1></div>
            <br>

            <form id="forma" action="./../controllers/procesarFormulario.php" method="POST">
                <input id="indice" hidden value="<?php echo $indice ?>">
                <div class="row g-5">
                    <div class="col-md-4">
                        <label for="rangesName" class="form-label">Nombre del Conjunto de Rangos</label>
                        <input type="text" name="rangesName" id="rangesName" class="form-control" required value="<?php echo $rangoSet['rangesName']; ?>">
                    </div>
                        
                    <div class="col-md-4">
                        <label for="createdBy" class="form-label">Creado por</label>
                        <input type="text" name="createdBy" id="createdBy" class="form-control" required value="<?php echo $rangoSet['createdBy']; ?>">
                    </div>
                        
                    <div class="col-md-2">
                        <label for="fecha" class="form-label">Fecha de creación</label>
                        <!--input type="date" name="fecha" id="fecha" class="form-control"-->
                        <div id="fecha" class="fechaCreacion"></div>
                    </div>     
                </div> <!--fin de la primera fila de campos --> 

                <br><br>
                
                <!--div-->
                    <!-- ----------------------- campos ---------------------->

                <div class="row g-5">  <!--Segunda fila de campos -->                        
                    <div class="col-md-2 form-check">                            
                        <label for="leftLimit" class="form-check-label">Tipo de límite</label>
                        <select name="leftLimit" id="leftLimit" class="form-select">
                            <option value="true" selected>abierto (</option>
                            <option value="false">cerrado [</option>
                        </select>                        
                    </div>  

                    <div class="col-md-2">                            
                        <label for="left" class="form-label">Límite inferior</label>
                        <input type="number" name="left" id="left" class="form-control" min="1" max="999" >                            
                    </div>          
                    
                    <div class="col-md-2">
                        <label for="right" class="form-label">Límite superior</label>
                        <input type="number" name="right" id="right" class="form-control" min="1" max="999" >
                    </div>     
                    
                    <div class="col-md-2 form-check">                            
                        <label for="rightLimit" class="form-check-label">Tipo de límite</label>
                        <select name="rightLimit" id="rightLimit" class="form-select">
                            <option value="true" selected>abierto )</option>
                            <option value="false">cerrado ]</option>
                        </select>                        
                    </div>           
                        
                </div><br>

                <div class="row g-5">

                    <div class="col-md-2">
                        <label for="colorTexto" class="form-label">Color de letra</label>
                        <!--input type="color" name="colorTexto" id="colorTexto" class="form-control" value="#ffffff"-->
                        <select id="colorTexto" class="colorTexto" name="colortexto">
                            <option value="#ffffff" style="color:#ffffff; background-color:#000000;">blanco</option>
                            <option value="#000000" style="color:#000000; background-color:#ffffff;">negro</option>
                        </select>
                    </div>  
                    

                    <div class="col-md-2">
                        <label for="colorFondo" class="form-label">Color de fondo</label>
                        <!--input type="color" name="colorFondo" id="colorFondo" class="form-control"-->
                        <select id="colorFondo" class="colorFondo" name="colorFondo">
                            <!--option value="#ffffff" style="color:#ffffff; background-color:#000000;">blanco</option>
                            <option value="#000000" style="color:#000000; background-color:#ffffff;">negro</option-->
                        </select>
                    </div>  
                    
                                        
                    <div class="col-md-2">                    
                        <label for="nuevoRango" class="form-label">Nuevo rango</label>
                        <div class="leyenda" name="nuevoRango" id="nuevoRango" style="background-color:#000000; color:#ffffff; width: 80px;"></div>
                        <div id="agregar" class="agregar"><span>Agregar +</span></div>
                        <!--input type="text" name="muestra" id="muestra" class="form-control"-->
                    </div>   

                </div>  <!--fin de la primera fila de campos -->

                <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
                <div class="errores" id="errores">

                </div>
                <div class="informar" id="informar">

                </div>
                

            </form><br>
        </div> <!-- fin de la clase formulario-->

        

        <!-------------------------------- Rangos --------------------------->

        <div class="rangosTitle">
            <span>Rangos</span>
        </div>
        <div class="leyendas" id="leyendas">

            <?php echo $leyendasHtml;?>
            <!--div class="leyenda">
                <div draggable="true" style="background-color:#000000; color:#ffffff;">[0, 10)</div>
            </div>
                        
            <div class="leyenda">
                <div draggable="true" style="background-color:#00ff00; color:#ffffff;">[10, 30)</div>
            </div-->
        </div><!-- fin leyendas -->   
        
        <!-------------------------------- Papelera --------------------------->

        <div class="papelera" id="papelera" dropzone="move">
            <p>Para eliminar un rango, arrástralo hasta la papelera</p>
            <img src="./../../img/papelera-de-reciclaje.png" alt="papelera">
        </div>

        <br><br><br>

        
        
    </div><!-- fin del contenedor-->
    <script src="./../../js/funciones.js">
        
        

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>