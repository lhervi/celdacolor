<?php
require __DIR__ . '/../vendor/autoload.php';

// Habilita la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Importa el namespace DI
use DI\Container;

// Crea el contenedor de dependencias
$container = new Container(); // Aquí debería funcionar ahora

// Crea la aplicación Slim pasando el contenedor
$app = new \Slim\App($container);

// Define una ruta simple
$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("¡Hola, Mundo!");
    return $response;
});

// Ejecuta la aplicación
$app->run();
