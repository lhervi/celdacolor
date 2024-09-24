function ordenaRangos(){          

    listaDeRangos.sort((a, b)=>{
        return a.left - b.left
    })
    console.log(listaDeRangos);
}

function limpiar(){
    menor.value="";
    mayor.value="";    
    actualizarFecha();
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
    if (Number(minimo) > Number(maximo)){
        error=true;
    }
    return error;
}

function limpiarDespuesDeGuardar(){
    listaDeRangos.splice(0, listaDeRangos.length);
    leyendas.innerHTML = "";
    menor.value = "";
    mayor.value = "";
    nuevoRango.innerText = "";  
    createdBy.value = "";
    rangesName.value = "";      
    rangesName.focus();
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

    if (listaDeRangos.length>0){
        guardar.disabled = false;            
    }else{
        guardar.disabled = true;
    }

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
    limpiarInformacion();
    listaDeRangos.splice(0, listaDeRangos.length);
    //const informarDiv = document.getElementById('informar');
    const infDiv = document.createElement('div');
    infDiv.setAttribute('class', 'alert alert-primary  mt-4');
    infDiv.setAttribute('role', 'alert');
    infDiv.innerText = mensaje;
    informarDiv.appendChild(infDiv);    
}

function limpiarInformacion(){
    //const informarDiv = document.getElementById('informar');
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

function actualizarFecha(){
    hoy = new Date();
    aaaa = hoy.getFullYear();
    mm = hoy.getMonth() +1 ;
    dd = hoy.getDate();
    hh = hoy.getHours();
    min = hoy.getMinutes();
    fecha.innerText = aaaa + "-" + mm + "-" + dd + " " + hh + ":" + min;
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
    
    actualizarFecha();
    

    const contenido = leftLimitValue + menor.value + ", " + mayor.value + rightLimitValue;
    nuevoRango.textContent  = contenido;
    nuevoRango.style.backgroundColor = colorFondo.value;
    nuevoRango.style.color = colorTexto.value;   
                    
    if(regexMuestra.test(contenido)){
        agregar.hidden =  false;                      
    }else{
        agregar.hidden =  true;                 
    }

    a=5;

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

    rangesName.addEventListener('input', update);
    
    createdBy.addEventListener('input', update);
    
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
    
    menor.value = rangoInfo.menor;
    mayor.value = rangoInfo.mayor;
    nuevoRango.innerText = rangoInfo.nuevoRango;
    nuevoRango.style.background = rangoInfo.background;
    colorTexto.value = rangoInfo.color;
    colorFondo.value =  rangoInfo.background;
    leyendas.innerHTML = rangoInfo.leyendas;                   
}
 
function enviarFormulario(e){
    e.preventDefault();      //nueva linea          
    actualizarFecha();
    rangoSet = {
        "rangesName":rangesName.value,
        "fechaCreacion":fecha.innerText,
        "createdBy":createdBy.value,
        "ranges" : listaDeRangos
    };

    const indiceInput = document.getElementById('indice');
    const indice = indiceInput.value;

    rangoSetJson = JSON.stringify(rangoSet);

    const formData = new FormData();

    formData.append('rangoSet', rangoSetJson);
    formData.append('indice', indice);
    

    const forma = document.getElementById('forma');
    //forma.addEventListener('submit', (e)=> {
        //e.preventDefault();               

        fetch(forma.action, {
            method: 'POST',
            body:formData
        })
        .then(response =>{
            
            console.log("Encabezados de respuesta:", response.headers); 

            if (!response.ok) {
                console.error('Error en la solicitud:', response.statusText);
                return;
            }
            informarGuardado("el conjuto de rango fue guardado satisfactoriamente");
            //rango = getEmtyRango();
            //inicializarCampos(rango);            
            limpiarDespuesDeGuardar();
            return response.json();    
        })
        .then(data => {
            console.log ("respuesta del servidor", data);
        })
        .catch(error => {
            console.error("error al enviar", error);
        });
    //});
    
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
    const informarDiv = document.getElementById('informar');
    

    const guardar = document.getElementById('guardar');

    actualizarFecha();

    var listaDeRangos

    console.log(leyendas.children.length);

    if(leyendas.children.length > 0){
        const listaRangos = document.getElementById('listaRangos');
        listaDeRangos = JSON.parse(listaRangos.value);
        console.log(listaDeRangos);

        Array.from(leyendas.children).forEach(child =>{
            child.addEventListener('dragstart', inicioArrastre);
            child.addEventListener('dragend', finArrastre);   
        });
 
        a=5;        
    }else{
        listaDeRangos = [];
    }

    
    

    papelera.addEventListener('dragover', sobrePapelera);
    papelera.addEventListener('drop', soltarEnPapelera);

    const forma = document.getElementById('forma');
    forma.addEventListener('submit', enviarFormulario);        
        
    asignarEventos();
