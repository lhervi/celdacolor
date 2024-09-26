<?php

include __DIR__ . "./../models/ranges/classRangos.php";


$nombre = trim($_POST['nombre']);

$objRangos = new Rangos();
$repetido = $objRangos->elNombreEstaRepetido($nombre);
$resultado = json_encode(["repetido" => $repetido]);
$a=5;
echo $resultado;


