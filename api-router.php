<?php
require_once './libs/Router.php';
require_once './app/controllers/series-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('series', 'GET', 'SeriesApiController', 'getTasks');
$router->addRoute('series/:ID', 'GET', 'SeriesApiController', 'getTask');
$router->addRoute('series/:ID', 'DELETE', 'SeriesApiController', 'deleteTask');
$router->addRoute('series', 'POST', 'SeriesApiController', 'insertTask'); 
$router->addRoute("series/:ID", "PUT", "SeriesApiController", "updateTask");
// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);