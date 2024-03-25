<?php
use Speaker\cores\Route;
use Speaker\controllers\HomeController;
use Speaker\controllers\E404Controller;

$route = new Route();

//register routing
$route->get('/', [HomeController::class, 'index']);
$route->get('/404', [E404Controller::class, 'index']);

$route->run();
?>