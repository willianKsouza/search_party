<?php

namespace App\Http\Users;

use App\DTO\CreateUserDTO;
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
      $this->createUserService->create($dto);
      $response->getBody()->write(json_encode(['success' => true]));
      return $response->withStatus(201);

    } catch (Exception $e) {
      $payload = json_encode(['success' => true,'error' => $e->getMessage()]);
      $response->getBody()->write($payload);
      return $response->withStatus(302);
    }
  }
}
