<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./../../css/style.css">
    <title>Gestión de Conjuntos de Rangos</title>
</head>
<body>
<div class="container  mt-3">
    <?php 
        include_once __DIR__ . "/../models/tabla/classTableRangosCrud.php"; 
        include __DIR__ . '/components/menu.php';         
    ?>    
    <div class="container">
        <div class="forma" >            
            <form action="./editSetRangos.php" method="GET" id="forma">
                    <input type="text" id="inputHidden" hidden name="indice">
                    <?php echo TableRangosCrud::getTableRangos(); ?>
            </form>
        </div>        
    </div>

    <script>

        const acciones = document.querySelectorAll('.accion');
        acciones.forEach((accion)=>{
            accion.addEventListener('click', menejarClick);
        });        

                
        function getConfirmacion(){
            $respuesta = confirm("¿Esta seguro que desea borrar este conjunto de rangos?");
            return $respuesta;
        }

        function deleteFunction(e){

            if(!getConfirmacion()){
                return;
            }

            posicion = e.target.getAttribute('pos');
            url ="./../controllers/borrarRangosSet.php?indice=" + posicion;

            fetch(url)
                .then(result => result.json())
                .then(data =>{
                    console.log(data);                    
                    alert(data.mensaje);
                    location.reload();
                });
        }

        function addFunction(e){            
            window.open('./createSetRangos.php', '_blank');
        }

        function editFunction(e){    
            
            const indice = document.getElementById('inputHidden');
            indice.value = e.target.getAttribute('pos');
            const forma = document.getElementById('forma');
            if(indice.value){
                forma.submit();
            }                        
        }

        function asignarEventos(){
            botonesAdd.forEach((boton, ind) => {
                boton.addEventListener('click', addFunction);
            });

            botonesDelete.forEach((boton, ind) => {
                boton.addEventListener('click', deleteFunction);
            });

            botonesEdit.forEach((boton, ind) => {
                boton.addEventListener('click', editFunction);
            });
        }
        
        const botonesEdit = document.querySelectorAll('.edit');
        const botonesDelete = document.querySelectorAll('.delete');
        const botonesAdd = document.querySelectorAll('.add');
        asignarEventos();
        a=5;

    </script>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</div>
</html>