<?php


ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';
use app\machina\Application;
use app\controllers\SiteController;
use app\controllers\AuthenticationController;

$app = new Application(dirname(__DIR__));

$app->router->get('/about', 'about-us');
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthenticationController::class, 'login']);
$app->router->post('/login', [AuthenticationController::class, 'login']);
$app->router->get('/register', [AuthenticationController::class, 'register']);
$app->router->post('/register', [AuthenticationController::class, 'register']);





$app->run();
