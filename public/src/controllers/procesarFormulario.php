<?php

try {
    include_once (__DIR__ . "./../models/ranges/classProcesarFormulario.php");

    $rangoSet = $_POST['rangoSet'];
    $rangoSetArray = json_decode($rangoSet, true);

    // Validar datos
    if (is_null($rangoSetArray)) {
        throw new Exception('Datos inválidos');
    }

    // Procesar datos
    
    $procesarDatos = ProcesarFormulario::guardarRangosSet($rangoSetArray);

    if($procesarDatos){
        $headers = array(
            "HTTP/1.1 200 OK",
            "Content-Type: application/json",
            "Cache-Control: no-cache"
        );
    
        foreach ($headers as $header) {
            header($header);
        }
    
        echo json_encode(['mensaje' => 'Datos procesados correctamente']);
    }else{
        throw new Exception ("los datos no pudieron procesarse");
    }

    // Enviar respuesta
    
} catch (Exception $e) {
    // Manejar el error
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
