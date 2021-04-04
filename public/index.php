<?php

require_once __DIR__.'/../vendor/autoload.php';
use app\machina\Application;

$app = new Application(dirname(__DIR__));

$app->router->fillRoutes('/about', 'about-us');

$app->router->fillRoutes('/', 'home');

$app->run();
