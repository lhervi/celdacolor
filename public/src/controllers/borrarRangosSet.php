<?php

include_once __DIR__ . "./../models/ranges/classBorrarRangoSet.php";

if (isset($_GET["indice"])){
    $indice =  intval($_GET["indice"]);
    $resultado = BorrarRangoSet::borrar($indice);
    if($resultado){
        $mensaje = "el registro fue eliminado";
        $valor = 1;
        $ok = $resultado;
        $salida = ["mensaje"=>$mensaje, "todoOk" => $ok, "valor"=>$valor];
    }else{
        $mensaje = "debe suminstrar una indice válido";
        $valor = 0;
        $ok = false;
        $salida = ["mensaje"=>$mensaje, "todoOk" => $ok, "valor"=>$valor]; 
    }

}else{
    $mensaje = "debe suminstrar una indice";
    $valor = 0;
    $ok = false;
    $salida = ["mensaje"=>$mensaje, "todoOk" => $ok, "valor"=>$valor];    
}

echo json_encode($salida);

///var/www/html/celdacolor/public/src/controllers/borrarRagosSet.php