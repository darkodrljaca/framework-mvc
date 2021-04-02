<?php

require_once __DIR__.'/../vendor/autoload.php';
use app\machina\Application;

$app = new Application();

$app->router->fillRoutes('/', function(){
    return "Pozdrav";
});

$app->router->fillRoutes('/about', function(){
    return "About us";
});

$app->run();
