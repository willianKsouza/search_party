<?php

namespace App\Http\Users;

use App\DTO\Users\CreateUserDTO;
use App\Services\Users\CreateUserService;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateUserController
{
  public function __construct(private CreateUserService $createUserService) {}
  public function create(Request $request, Response $response, array $args)
  
  {
    try {
      $params = (array)$request->getParsedBody();
      $dto = new CreateUserDTO(
        $params['email'],
        $params['password'],
        $params['username'],
        $params['bio']
      );
      $this->createUserService->execute($dto);
      $response->getBody()->write('');
      return $response->withStatus(204)->withHeader('Content-Type', 'application/json');

    } catch (Exception $e) {
      $payload = json_encode(['success' => false,'error' => $e->getMessage()],JSON_UNESCAPED_UNICODE);

      $response->getBody()->write($payload);
      
      return $response->withStatus($e->getCode())->withHeader('Content-Type', 'application/json');
    }
  }
}
