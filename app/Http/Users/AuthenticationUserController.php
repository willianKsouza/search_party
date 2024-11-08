<?php

namespace App\Http\Users;

use App\DTO\AuthDTO;
use App\Services\Users\AuthenticationUserService;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '../../../../');
$dotenv->load();

class AuthenticationUserController
{
    public function __construct(private AuthenticationUserService $uthenticationUserService) {}

    public function index(Request $request, Response $response, array $args)
    {

        try {

            $params = (array)$request->getParsedBody();
            $dto = new AuthDTO($params['email'], $params['password']);
            $user = $this->uthenticationUserService->login($dto);
            $payload = [
                'user_id' => $user->idUser,
                'exp' => time() + 
                3600,
            ];
            $token = JWT::encode($payload, $_ENV['JWT_KEY'], 'HS256');
            $response->getBody()->write(json_encode(['user' => $user, 'token' => $token]));
            return $response->withStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
