<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./../../css/style.css">
    <title>Crear Conjunto de Rangos</title>
</head>
<body>
    <div class="container mt-5">
        <div class="formulario">
        
            <div><h1 class="mb-4">Formulario para añadir un conjunto de Rangos</h1></div>
            <br>

            <form id="forma">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="rangesName" class="form-label">Nombre del Conjunto de Rangos</label>
                        <input type="text" name="rangesName" id="rangesName" class="form-control">
                    </div>
                        
                    <div class="col-md-4">
                        <label for="createdBy" class="form-label">Creado por</label>
                        <input type="text" name="createdBy" id="createdBy" class="form-control">
                    </div>
                        
                    <div class="col-md-2">
                        <label for="fecha" class="form-label">Fecha de creación</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                    </div>     
                </div> <!--fin de la fila -->

                <br><br>
                
                <div>
                    <!-- ----------------------- campos ---------------------->

                    <div class="row g-5">
                        
                        <div class="col-md-1 form-check">                            
                            <input type="radio" name="leftLimit" id="leftLimitOpen" class="form-check-input" value="true">
                            <label for="leftLimit" class="form-check-label">abierto</label>
                            
                            <input type="radio" name="leftLimit" id="leftLimitClose" class="form-check-input" value="false">
                            <label for="rightLimit" class="form-check-label">cerrado</label>
                        </div>  

                        <div class="col-md-2">                            
                            <label for="left" class="form-label">Límite inferior</label>
                            <input type="text" name="left" id="left" class="form-control">                            
                        </div>  

                        <div class="col-md-2">
                            <label for="left" class="form-label">Etiqueta</label>
                            <input type="text" name="left" id="left" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <label for="left" class="form-label">Color de letra</label>
                            <input type="color" name="left" id="left" class="form-control">
                        </div>  
                        
                    </div><br>
                    <div class="row g-5">

                        <div class="col-md-1 form-check">                            
                            <input type="radio" name="rightLimit" id="leftLimitOpen" class="form-check-input" value="true">
                            <label for="rightLimit" class="form-check-label">abierto</label>
                            
                            <input type="radio" name="rightLimit" id="leftLimitClose" class="form-check-input" value="false">
                            <label for="rightLimit" class="form-check-label">cerrado</label>
                        </div>  

                        <div class="col-md-2">
                            <label for="right" class="form-label">Límite superior</label>
                            <input type="text" name="right" id="right" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label for="left" class="form-label">Color de fondo</label>
                            <input type="color" name="left" id="left" class="form-control">
                        </div>  
                        
                        

                    </div>
                    
            </form>   

            <!--div></br><span id="mas" class="clickable"> Añadir rango + </span><br></div-->
        </div>
    </div>
    <script>

        function addNewRange(){

            const newDiv = document.createElement('div');
            newDiv.className = 'col-md-2';

            const label = document.createElement('Límite');
            label.setAttribute('for', 'fecha');
            label.className = 'form-label';
            label.textContent = 'Fecha de creación';

            const input = document.createElement('input');
            input.type = 'date';
            input.name = 'fecha';
            input.id = 'fecha';
            input.className = 'form-control';

            newDiv.appendChild(label);
            newDiv.appendChild(input);

            const forma = document.getElementById('forma');

            forma.appendChild(newDiv);

        }

        const mas = document.getElementById('mas');
        mas.addEventListener('click', addNewRange);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>