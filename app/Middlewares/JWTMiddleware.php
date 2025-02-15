<?php

namespace App\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as Psr7Response;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

$dotenv = Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();


class JWTMiddleware
{
    public function __invoke(Request $request, Handler $handler): Response
    {
        $response = new Psr7Response();
        $authHeader = $request->getHeader('Authorization');
        $contextHeader = $request->getHeader('X-Context');
        if(!empty($contextHeader) && $contextHeader[0] == 'change-password'){
            return $handler->handle($request);
        }
        if (!$authHeader) {
            $response->getBody()->write(json_encode(['error' => 'Token nao fornecido']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }
        $token = str_replace('Bearer ', '', $authHeader[0]);

        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_KEY'], 'HS256'));
            return $handler->handle($request);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => 'token invalido']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }
    }
}
