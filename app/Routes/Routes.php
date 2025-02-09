<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../Dependency_injection/Authentication/AuthenticationUserDI.php';
require __DIR__ . '/../Dependency_injection/Users/CreateUserDI.php';
require __DIR__ . '/../Dependency_injection/Users/ActivationUserDI.php';
require __DIR__ . '/../Dependency_injection/Users/FindUserByIdDI.php';
require __DIR__ . '/../Dependency_injection/Users/UpdateUserDI.php';
require __DIR__ . '/../Dependency_injection/Users/DeleteUserDI.php';
// require __DIR__ . '/../Dependency_injection/Users/ForgotPasswordDI.php';

use App\Middlewares\CreatePostValidate;
use App\Middlewares\CreateUserValidate;
use App\Middlewares\JWTMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {


    $app->group('/api', function (RouteCollectorProxy $group){
        global $AuthenticationUserController;
        // global $ForgotPasswordController;
        $group->post('/login', [$AuthenticationUserController, 'index']);
        // $app->get('/api/forgot', [$ForgotPasswordController, 'send']);
    });




    $app->group('/api/user', function (RouteCollectorProxy $group) {
        global $CreateUserController;
        global $UpdateUserController;
        global $DeleteUserController;
        global $ActivationUserController;
        global $FindUserByIdController;
        $group->post('/create', [$CreateUserController, 'create'])->add(new CreateUserValidate());
        $group->post('/activation/{id}', [$ActivationUserController, 'activateAccount']);
        $group->get('/{id}', [$FindUserByIdController, 'findById']);
        $group->put('/update/{id}', [$UpdateUserController, 'update']);
        $group->delete('/delete/{id}', [$DeleteUserController, 'delete']);
    });


    $app->group('/api/post', function (RouteCollectorProxy $group) {
        global $CreatePostController;
        $group->post('/create', [$CreatePostController, 'create'])->add(new CreatePostValidate());
    })->add(new JWTMiddleware());
};
