<?php
require __DIR__ . '/../vendor/autoload.php';

// Habilita la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configura el contenedor de dependencias
$container = new \DI\Container();
$app = new \Slim\App($container);

// Define una ruta simple
$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("¡Hola, Mundo!");
    return $response;
});

// Ejecuta la aplicación
$app->run();
