<?php
require_once './libs/Router.php';
require_once './app/controllers/series-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('series', 'GET', 'SeriesApiController', 'getseries');
$router->addRoute('series/:ID', 'GET', 'SeriesApiController', 'getserie');
$router->addRoute('series/:ID', 'DELETE', 'SeriesApiController', 'deleteSerie');
$router->addRoute('series', 'POST', 'SeriesApiController', 'insertSerie'); 
$router->addRoute("series/:ID", "PUT", "SeriesApiController", "updateSerie");
// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']); 