<?php
require __DIR__.'/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();

(require '../app/Routes/Routes.php')($app);
$app->run();