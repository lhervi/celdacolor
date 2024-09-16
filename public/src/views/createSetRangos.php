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

            <form id="forma" action="./../controllers/procesarFormulario.php" method="POST">
                <!--http://localhost/celdacolor/public/src/controllers/procesarFormulario.php-->
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
                        <input type="number" name="left" id="left" class="form-control" min="1" max="999" required>                            
                    </div>          
                    
                    <div class="col-md-2">
                        <label for="right" class="form-label">Límite superior</label>
                        <input type="number" name="right" id="right" class="form-control" min="1" max="999" required>
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

                    <!--div class="col-md-2">
                        <label for="etiquetaColorTexto" class="form-label">Nombre del color</label>
                        <input type="text" id="etiquetaColorTexto" class="form-control">
                    </div-->

                    <div class="col-md-2">
                        <label for="colorFondo" class="form-label">Color de fondo</label>
                        <!--input type="color" name="colorFondo" id="colorFondo" class="form-control"-->
                        <select id="colorFondo" class="colorFondo" name="colorFondo">
                            <!--option value="#ffffff" style="color:#ffffff; background-color:#000000;">blanco</option>
                            <option value="#000000" style="color:#000000; background-color:#ffffff;">negro</option-->
                        </select>
                    </div>  
                    
                    <!--div class="col-md-2">
                        <label for="etiquetaColorFondo" class="form-label">Nombre del color</label>
                        <input type="text" name="etiquetaColorFondo" id="etiquetaColorFondo" class="form-control">
                    </div-->   
                    
                    <div class="col-md-2">                    
                        <label for="nuevoRango" class="form-label">Nuevo rango</label>
                        <div class="leyenda" name="nuevoRango" id="nuevoRango" style="background-color:#000000; color:#ffffff; width: 80px;"></div>
                        <div id="agregar" class="agregar"><span>Agregar +</span></div>
                        <!--input type="text" name="muestra" id="muestra" class="form-control"-->
                    </div>   

                </div>  <!--fin de la primera fila de campos -->

                <button type="submit" id="guardar" class="btn btn-primary" disabled="true">Guardar</button>
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

        function ordenaRangos(){          

            listaDeRangos.sort((a, b)=>{
                return a.left - b.left
            })
            console.log(listaDeRangos);
        }

        function limpiar(){
            left.value="";
            right.value="";
            nuevoRango.innerText =""
        }

        function limpiarErrores(){
            const erroresDiv = document.getElementById('errores');
            erroresDiv.innerHTML = "";
        }

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
                    eliminaRango(parseInt(idLeyenda));
                    console.log('Elemento eliminado:', idLeyenda);                    
                }
                })

                //leyenda.parentNode.remove();
                
            }
        }

        function eliminaRango(idLeyenda){
            listaDeRangos.splice(idLeyenda, 1);
        }

        function yaExiste(contenido){
            //Evaluar si ya hay un rango similar
            existe = listaDeRangos.some(rango => rango.contenido === contenido);                            
            return existe;
        }

        function menorRepetido(menor){            
            existe = listaDeRangos.some(rango=> rango.left === menor);
            return existe;
        }
        function mayorRepetido(mayor){            
            existe = listaDeRangos.some(rango=> rango.right === mayor);
            return existe;
        }
        function coloresRepetidos(color, fondo){            
            existeColor = listaDeRangos.some(rango=> rango.color === color);
            existeFondo = listaDeRangos.some(rango=> rango.backgroundColor === fondo);
            existe = existeColor && existeFondo;
            return existe;
        }

        function evalMinimo(minimo, maximo){
            error = false;
            if (minimo > maximo){
                error=true;
            }
            return error;
        }



        function hayRepetidos(rango){
            errores = [];
            if (yaExiste(rango.contenido)){
                errores.push("ese rango ya existe");                
            }
            if(menorRepetido(rango.left)){
                errores.push("ese valor de rango mínimo ya existe");
            }
            if(mayorRepetido(rango.right)){
                errores.push("ese valor de rango máximo ya existe");
            }
            if(coloresRepetidos(rango.color, rango.backgroundColor)){
                errores.push("ya existe una combinación de color de letra y fondo similar");
            }
            return errores;
        }

        function addNewRange(idLeyenda, rangoObj){

            //const rangoObj = getRangoObj();
            

            const newDiv = document.createElement('div');
            newDiv.className = 'leyenda';
            const newEtiqueta = document.createElement('div');
            newEtiqueta.setAttribute("style", "background-color:" + rangoObj.backgroundColor + "; color:" + rangoObj.color + ";");
            newEtiqueta.setAttribute("data-id-leyenda", idLeyenda);

            newEtiqueta.setAttribute('draggable', true);
            
            // Se añaden eventos para el borrado
            newEtiqueta.addEventListener('dragstart', inicioArrastre);
            newEtiqueta.addEventListener('dragend', finArrastre);   

            //newEtiqueta.textContent = nuevoRango.textContent;
            newEtiqueta.textContent = rangoObj.contenido;
            newDiv.appendChild(newEtiqueta);
            leyendas.appendChild(newDiv);

            console.log ("leyenda añadida");
            
        }

        function getRangoObj(){            

            leftLimitSymbol = leftLimit.value == "true" ? "(" : "[";   
            rightLimitSymbol = rightLimit.value == "true" ? ")" : "]"; 
                        
            const rango = {
                "left" : menor.value,
                "right" : mayor.value,
                "leftOpen" : leftLimit.value,
                "rightOpen" : rightLimit.value,
                "colorName" : colorTexto.options[colorTexto.selectedIndex].text,
                "color" : colorTexto.value,
                "backgroundColorName" : colorFondo.options[colorFondo.selectedIndex].text,
                "backgroundColor": colorFondo.value,
                "leftSymbol" : leftLimitSymbol,
                "rightSymbol"   : rightLimitSymbol,
                "contenido" : leftLimitSymbol + menor.value + ", " + mayor.value + rightLimitSymbol
            };
            return rango
        }

        function getRangoJson(){            
            const rangoJson = getRangoObj();
            return JSON.stringify(rangoJson);
        }

        function pintarRangos(){
            if (listaDeRangos.length>0){
                leyendas.innerHTML="";
                listaDeRangos.forEach((leyenda, idLeyenda)=>{
                    addNewRange(idLeyenda, leyenda);
                });
            }
        }

        function addRango(){            
            
            rangoObj = getRangoObj();     
            
            const regexMuestra = /^(?:\[|\()[0-9]{1,3},\s[0-9]{1,3}(?:\]|\))$/;
            
            errores = hayRepetidos(rangoObj);
            if(evalMinimo(rangoObj.left, rangoObj.right)){
                errores.push("el valor mínimo debe ser menor o igual al valor máximo");
            }

            if (errores.length>0){
                mostrarErrores(errores);
                return;
            }                      
            
            listaDeRangos.push(rangoObj);     
            //ordena los rangos de mayor a menor
            if (listaDeRangos.length>1){
                listaDeRangos.sort((a, b)=>{
                    return a.left - b.left
                });
            }

            limpiar();
            pintarRangos();

        }

        function informarGuardado(mensaje){
            limpiar();
            const informarDiv = document.getElementById('informar');
            infDiv = document.createElement('div');
            infDiv.setAttribute('class', '"alert alert-primary');
            infDiv.setAttribute('role', 'alert');
            infDiv.innerText(mensaje);
            informarDiv.appendChild(infDiv);
        }

        function limpiarInformacion(){
            const informarDiv = document.getElementById('informar');
            informarDiv.innerHTML = "";
        }
        
        function mostrarErrores(errores){            
            
            limpiarErrores();
            const erroresDiv = document.getElementById('errores');
            errores.forEach(error => {
                const divError = document.createElement('div');
                divError.setAttribute('class', 'alert alert-warning mt-4');
                divError.setAttribute('role', 'alert');
                divError.innerText = error;
                erroresDiv.appendChild(divError);                
            });
        }
        
        function update (e){         

            limpiarErrores();
            limpiarInformacion();

            leftLimitValue = "[";   
            rightLimitValue = "]";   
            
            if(leftLimit.value=="true"){
                leftLimitValue = "(";
            }
            if(rightLimit.value=="true"){
                rightLimitValue = ")";
            }

            const regexMuestra = /^(?:\[|\()[0-9]{1,3},\s[0-9]{1,3}(?:\]|\))$/;
            

            hoy = new Date();
            fecha.textContent = hoy.getFullYear() + "-" + hoy.getMonth() + "-" + hoy.getDay() + " " + hoy.getHours() + ":" + hoy.getMinutes();

            const contenido = leftLimitValue + menor.value + ", " + mayor.value + rightLimitValue;
            nuevoRango.textContent  = contenido;
            nuevoRango.style.backgroundColor = colorFondo.value;
            nuevoRango.style.color = colorTexto.value;   
                            
            if(regexMuestra.test(contenido)){
                agregar.hidden =  false;                      
            }else{
                agregar.hidden =  true;                 
            }

            if (listaDeRangos.length>0){
                guardar.disabled = false;            
            }else{
                guardar.disabled = true;
            }

        } 

        

        function asignarEventos(){            

            leftLimit.addEventListener('input', update);
            menor.addEventListener('input', update);
            mayor.addEventListener('input', update);            
            rightLimit.addEventListener('input', update);            
            background.addEventListener('input', update);
            color.addEventListener('input', update);
            
            agregar.addEventListener('click', addRango);     
            
            guardar.addEventListener('click', enviarFormulario);

        }

        function colorSelectLetras(){
            if(selectLetras.value === '#000000'){
                selectLetras.style.color = '#000000';  // Ajusta el color de la letra
                selectLetras.style.background = '#ffffff';                
            }else{
                selectLetras.style.color = '#ffffff'; 
                selectLetras.style.background = '#000000';
            }            
        }

        function initSelectColorFondo(){
            fetch('./../controllers/getOpcionesSelectColores.php')
                .then(response => response.text())
                .then(data =>{
                    selectFondo.innerHTML = data;
                    selectFondo.value = "#000000";
                })
                .catch(error =>{
                    console.error("error al obtener las opciones: " , error);
                });                                
        }
        
        function getEmtyRango(){
            rangoEmty = {
            "rangesName": "",
            "createdBy":"",
            "menor":"",
            "mayor":"",
            "nuevoRango":"(0, 10)",
            "colorTexto":"blanco",
            "colorFondo":"negro",
            "leyendas":"",
            "background":"#000000",
            "color":"#ffffff"
            };
            return rangoEmty;
        }
        
        function inicializarCampos(rangoInfo){
            rangesName.innerText = rangoInfo.rangesName;
            createdBy.innerText = rangoInfo.createdBy;
            menor.value = rangoInfo.menor;
            mayor.value = rangoInfo.mayor;
            nuevoRango.innerText = rangoInfo.nuevoRango;
            nuevoRango.style.background = rangoInfo.background;
            colorTexto.value = rangoInfo.color;
            colorFondo.value =  rangoInfo.background;
            leyendas.innerHTML = rangoInfo.leyendas;              
        }
        
        function enviarFormulario(e){
            
            rangoSet = {
                "rangesName":rangesName.value,
                "fechaCreacion":fecha.innerText,
                "createdBy":createdBy.value,
                "ranges" : listaDeRangos
            };

            rangoSetJson = JSON.stringify(rangoSet);

            const formData = new FormData();

            formData.append('rangoSet', rangoSetJson);

            const forma = document.getElementById('forma');
            forma.addEventListener('submit', (e)=> {
                e.preventDefault();               

                fetch(forma.action, {
                    method: 'POST',
                    body:formData
                })
                .then(response =>{
                    if (!response.ok) {
                        console.error('Error en la solicitud:', response.statusText);
                        return;
                    }
                    rango = getEmtyRango();
                    inicializarCampos(rango);
                    informarGuardado("el conjuto de rango fue guardado satisfactoriamente");
                    return response.json();    
                })
                .then(data => {
                    console.log ("respuesta del servidor", data);
                })
                .catch(error => {
                    console.error("error al enviar", error);
                });
            });
            
        }
        
        var value = "";

        const selectLetras = document.getElementById('colorTexto');
        initSelectColorFondo();
        selectLetras.addEventListener('change', colorSelectLetras);

        const selectFondo = document.getElementById('colorFondo');
        
        const fecha = document.getElementById('fecha');
        const rangesName = document.getElementById('rangesName');
        const createdBy = document.getElementById('createdBy');
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
        const colorTexto = document.getElementById('colorTexto');        
        const colorFondo = document.getElementById('colorFondo'); 
        const alertaDiv = document.getElementById('alerta');

        const guardar = document.getElementById('guardar');

        hoy = new Date();
        fecha.textContent = hoy.getFullYear() + "-" + hoy.getMonth() + "-" + hoy.getDay() + " " + hoy.getHours() + ":" + hoy.getMinutes();
        

        papelera.addEventListener('dragover', sobrePapelera);
        papelera.addEventListener('drop', soltarEnPapelera);

        const forma = document.getElementById('forma');
        forma.addEventListener('submit', enviarFormulario);        

        const listaDeRangos = [];       
        
        asignarEventos();


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>