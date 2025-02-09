<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

// $app->addErrorMiddleware(true, true, true);

// $customErrorHandler = function (
//     ServerRequestInterface $request,
//     Throwable $exception,
//     bool $displayErrorDetails,
//     bool $logErrors,
//     bool $logErrorDetails
// ) use ($app, $logger) {
//     if ($logger) {
//         $logger->error($exception->getMessage());
//     }

//     $payload = ['error' => $exception->getMessage()];

//     $response = $app->getResponseFactory()->createResponse();
//     $response->getBody()->write(
//         json_encode($payload, JSON_UNESCAPED_UNICODE)
//     );

//     return $response;
// };


$app->add(function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($app): ResponseInterface {
    if ($request->getMethod() === 'OPTIONS') {
        $response = new \Slim\Psr7\Response();
    } else {
        $response = $handler->handle($request);
    }
    $response = $response
        ->withHeader('Access-Control-Allow-Origin', $_ENV['FRONT_HOST'])
        ->withHeader('Access-Control-Allow-Headers', '*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE');
    return $response;
});

(require '../app/Routes/Routes.php')($app);

$app->run();
