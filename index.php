<?php

require_once __DIR__ . '/vendor/autoload.php';

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
//composer require vlucas/phpdotenv
use Dotenv\Dotenv;


// Inicializa dotenv para cargar las variables de entorno
//Se busca un .env en el directorio raiz
$dotenv = Dotenv::createImmutable(__DIR__);
//Cargamos las variables en el entorno
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {

    //rutas para CRUD
    $r->addRoute('GET', '/mostrar_clubs_view', ['Controlador\main_club_controller', 'listadoClubs']);
    $r->addRoute('GET', '/mostrar_clubs_view/{idClubGolf:\d+}', ['Controlador\main_club_controller', 'eliminarClub']);
    $r->addRoute('GET', '/listar_hoyos_view/{idClubGolf:\d+}', ['Controlador\cargar_hoyos_controller', 'eliminarClub']);
    
});

//Dependiendo de la solicitud haremos una cosa u otra 
//recomemos la url y si ha sido get post o cual
// Obtener datos de la solicitud
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Eliminar parámetros de la consulta
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Despachar la ruta
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // Ruta no encontrada
        http_response_code(404);
        echo "404 - Página no encontrada<br>Intentalo de nuevo";
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Método HTTP no permitido
        $allowedMethods = $routeInfo[1];
        http_response_code(405);
        echo "405 - Método no permitido. Métodos permitidos: " . implode(', ', $allowedMethods);
        break;

    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$class, $method] = $handler;

        $controller = new $class();
        //Llamamos a la funcion encargada de despachar la ruta
        $controller->$method($vars);

        break;
}
