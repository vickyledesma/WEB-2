<?php
require_once './libs/Router.php';
require_once './app/controllers/series-api.controller.php';


$router = new Router();


$router->addRoute('series', 'GET', 'SeriesApiController', 'Traigoseries');
$router->addRoute('series/:ID', 'GET', 'SeriesApiController', 'Traigoserie');
$router->addRoute('series/:ID', 'DELETE', 'SeriesApiController', 'BorroSerie');
$router->addRoute('series', 'POST', 'SeriesApiController', 'AgregoSerie'); 
$router->addRoute("series/:ID", "PUT", "SeriesApiController", "ActualizoSerie");

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']); 