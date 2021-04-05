<?php


ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';
use app\machina\Application;
use app\controllers\SiteController;

$app = new Application(dirname(__DIR__));
$app->router->get('/about', 'about-us');
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);



$app->run();
