<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./../../css/style.css">
    <title>Crear Conjunto de Rangos</title>
</head>
<body>
    <div class="container mt-5">
        <div class="formulario">
        
            <div><h1 class="mb-4">Formulario para añadir un conjunto de Rangos</h1></div>
            <br>

            <form id="forma">
                <div class="row g-5">
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
                        <input type="text" name="left" id="left" class="form-control">                            
                    </div>          
                    
                    <div class="col-md-2">
                        <label for="right" class="form-label">Límite superior</label>
                        <input type="text" name="right" id="right" class="form-control">
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
                        <input type="color" name="colorTexto" id="colorTexto" class="form-control" value="#ffffff">
                    </div>  

                    <div class="col-md-2">
                        <label for="etiquetaColorTexto" class="form-label">Nombre del color</label>
                        <input type="text" id="etiquetaColorTexto" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label for="colorFondo" class="form-label">Color de fondo</label>
                        <input type="color" name="colorFondo" id="colorFondo" class="form-control">
                    </div>  
                    
                    <div class="col-md-2">
                        <label for="etiquetaColorFondo" class="form-label">Nombre del color</label>
                        <input type="text" name="etiquetaColorFondo" id="etiquetaColorFondo" class="form-control">
                    </div>   
                    
                    <div class="col-md-2">                    
                        <label for="nuevoRango" class="form-label">Nuevo rango</label>
                        <div class="leyenda" name="nuevoRango" id="nuevoRango" style="background-color:#000000; color:#ffffff; width: 80px;">[0, 10)</div>
                        <div id="agregar" class="agregar"><span>Agregar +</span></div>
                        <!--input type="text" name="muestra" id="muestra" class="form-control"-->
                    </div>   

                </div>  <!--fin de la primera fila de campos -->
                    
            </form><br>
        </div> <!-- fin de la clase formulario-->

        

        <!-------------------------------- Rangos --------------------------->

        <div class="rangosTitle">
            <span>Rangos</span>
        </div>
        <div class="leyendas" id="leyendas">
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
    <script>

        
        function finArrastre(e){
            e.target.style.opacity='1'; //deprecated             
        }

        function inicioArrastre(e){
            const idLeyenda = e.target.getAttribute('data-id-leyenda');
            e.dataTransfer.setData('text', idLeyenda);
            e.target.style.opacity = '0.5';            
            console.log(`en la función inicioArrastre se seteo la variable text con ${idLeyenda}`);
        }

        //Permite que el elemento se suelte aquí
        function sobrePapelera(e){
            e.preventDefault();            
        }

        //Función para manejar el evento soltar
        function soltarEnPapelera(e){            
            e.preventDefault();
            console.log("Elemento soltado en la papelera");
            //Obtiene el id de leyenda
            const idLeyenda = e.dataTransfer.getData('text');
            const leyenda = document.querySelector(`[data-id-leyenda="${idLeyenda}"]`);

            // Obtener las coordenadas del mouse
            const mouseX = event.clientX;
            const mouseY = event.clientY;

            // Obtener las coordenadas y dimensiones de la papelera
            const papeleraRect = papelera.getBoundingClientRect();

            // Verificar si las coordenadas del mouse están dentro de la papelera
            if (
                mouseX >= papeleraRect.left &&
                mouseX <= papeleraRect.right &&
                mouseY >= papeleraRect.top &&
                mouseY <= papeleraRect.bottom
            ) { 

                Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas eliminar el elemento 'Nombre del elemento'?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'   

                }).then((result) => {
                if (result.isConfirmed)   
                {
                    // Eliminar el elemento
                    leyenda.parentNode.remove();
                    console.log('Elemento eliminado:', data);
                }
                })

                //leyenda.parentNode.remove();
                
            }
        }



        function addNewRange(){

            const idLeyenda = leyendas.querySelectorAll('.leyenda').length;

            const rangoObj = getRangoObj();

            let prueba = rangoObj.color;
            

            const newDiv = document.createElement('div');
            newDiv.className = 'leyenda';
            const newEtiqueta = document.createElement('div');
            newEtiqueta.setAttribute("style", "background-color:" + background.value + "; color:" + color.value + ";");
            newEtiqueta.setAttribute("data-id-leyenda", idLeyenda);

            newEtiqueta.setAttribute('draggable', true);
            
            newEtiqueta.addEventListener('dragstart', inicioArrastre);
            newEtiqueta.addEventListener('dragend', finArrastre);   

            newEtiqueta.textContent = nuevoRango.textContent;
            newDiv.appendChild(newEtiqueta);
            leyendas.appendChild(newDiv);

            console.log ("leyenda añadida");
            
        }

        function getRangoObj(){
            leftLimitJson = leftLimit.value == "true" ? true : false;   
            rightLimitJson = rightLimit.value == "true" ? true : false; 
            
            const rango = {
                "left":menor.value,
                "right":mayor.value,
                "leftOpen":leftLimitJson,
                "rightOpen":rightLimitJson,
                "colorName":etiquetaColorTexto.value,
                "color":color.value,
                "backgroundColorName":etiquetaColorFondo.value,
                "backgroundColor":background.value
            };
            return rango
        }

        function getRangoJson(){            
            const rangoJson = getRangoObj();
            return JSON.stringify(rangoJson);
        }

        function addRangoJson(){            
            rangoJson = getRangoJson();  
            listaDeRangos.push(rangoJson);
            addNewRange()  ;
            
            console.log (listaDeRangos);
        }

        function update (e){         

            leftLimitValue = leftLimit.value == "true" ? "(" : "[";   
            rightLimitValue = rightLimit.value == "true" ? ")" : "]";              

            nuevoRango.textContent  = leftLimitValue + menor.value + ", " + mayor.value + rightLimitValue;    
            nuevoRango.style.backgroundColor = background.value;
            nuevoRango.style.color = color.value;           

        }

        function asignarEventos(){            

            leftLimit.addEventListener('input', update);
            menor.addEventListener('input', update);
            mayor.addEventListener('input', update);            
            rightLimit.addEventListener('input', update);            
            background.addEventListener('input', update);
            color.addEventListener('input', update);
            agregar.addEventListener('click', addRangoJson);           

        }

        
        var value = "";


        const leftLimit = document.getElementById('leftLimit');
        const menor = document.getElementById('left');
        const mayor = document.getElementById('right');
        const rightLimit = document.getElementById('rightLimit');
        const background = document.getElementById('colorFondo');
        const color = document.getElementById('colorTexto');
        const etiquetaColorTexto = document.getElementById('etiquetaColorTexto');
        const etiquetaColorFondo = document.getElementById('etiquetaColorFondo');
        const nuevoRango = document.getElementById('nuevoRango');
        const mas = document.getElementById('mas');
        const agregar  = document.getElementById('agregar');
        const leyendas = document.getElementById('leyendas');
        const papelera = document.getElementById('papelera');

        papelera.addEventListener('dragover', sobrePapelera);
        papelera.addEventListener('drop', soltarEnPapelera);

        const listaDeRangos = [];       
        
        asignarEventos();


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>