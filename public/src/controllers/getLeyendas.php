<?php

header('Content-Type: application/json; charset=utf-8');
include_once __DIR__ . "/../models/ranges/classInfoLeyenda.php";

if (isset($_GET["nombreRangoLeyenda"])){
    $nombreLeyendaSet = $_GET["nombreRangoLeyenda"];
    $leyendasHtml = InfoLeyenda::getHtmlLeyendas($nombreLeyendaSet);
    $leyendasHtmlJson = json_encode(["leyendas"=>$leyendasHtml, "statusOk"=>true]);
    if($leyendasHtml==""){
        echo json_encode(["leyendas"=>"sin leyendas", "statusOk"=>false]);
    }
    echo $leyendasHtmlJson;
    exit;
}else{    
    $mensaje = "el conjunto de leyenda suministrado no corresponde con los registrados";
    echo json_encode(["leyendas"=>$mensaje, "statusOk"=>false]);
} 
