<?php


ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

use app\machina\Application;
use app\controllers\SiteController;
use app\controllers\AuthenticationController;
use app\models\User;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

// $app->router->get('/about', 'about-us');
$app->router->get('/about', [SiteController::class, 'about']);
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthenticationController::class, 'login']);
$app->router->post('/login', [AuthenticationController::class, 'login']);
$app->router->get('/register', [AuthenticationController::class, 'register']);
$app->router->post('/register', [AuthenticationController::class, 'register']);
$app->router->get('/logout', [AuthenticationController::class, 'logout']);
$app->router->get('/profile', [AuthenticationController::class, 'profile']);





$app->run();
