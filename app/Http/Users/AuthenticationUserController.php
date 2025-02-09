<?php

namespace App\Http\Users;


use Exception;
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use App\DTO\Users\AuthDTO;
use App\Services\Users\AuthenticationUserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
            $user = $this->uthenticationUserService->execute($dto);
            // 'exp' => time() + (6 * 3600)
  
            $payload = [
                'user_id' => $user['id_user'],
                'exp' => time() + 30
            ];
  
            $token = JWT::encode($payload, $_ENV['JWT_KEY'], $_ENV['ALG']);
            $response->getBody()->write(json_encode([ 'token' => $token]));
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['sucess' => false]));
        }
    }
}
