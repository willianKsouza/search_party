<?php

require __DIR__ . '/../Dependency_injection/Authentication/AuthenticationUserDI.php';
require __DIR__ . '/../Dependency_injection/CreateUser/CreateUserDI.php';
require __DIR__ . '/../Dependency_injection/Posts/CreatePostDI.php';
require __DIR__ . '/../Dependency_injection/Users/ForgotPasswordDI.php';
require __DIR__ . '/../../vendor/autoload.php';

use App\Middlewares\CreatePostValidate;
use App\Middlewares\CreateUserValidate;
use App\Middlewares\JWTMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    global $AuthenticationUserController;
    global $CreateUserController;
    global $ForgotPasswordController;

    $app->post('/login', [$AuthenticationUserController, 'index']);
    $app->post('/user/create', [$CreateUserController, 'create'])->add(new CreateUserValidate());
    $app->get('/forgot', [$ForgotPasswordController, 'send']);
    $app->group('', function (RouteCollectorProxy $group){
        global $CreatePostController;


        $group->post('/post/create', [$CreatePostController, 'create'])->add(new CreatePostValidate());
    })->add(new JWTMiddleware());
    
};
