<?php

namespace App\Http\Users;

use App\DTO\Users\AuthUpdateDTO;
use App\Services\Users\AuthUpdatePasswordService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthUpdatePasswordController
{
    public function __construct(private AuthUpdatePasswordService $authUpdatePasswordService) {}
    public function update(Request $request, Response $response, array $args)
    {
        $params = (array)$request->getParsedBody();
        $id = $args['id'];
        $dto = new AuthUpdateDTO();
        $dto->idUser = $id;
        $dto->password = $params['password'];
        $user = $this->authUpdatePasswordService->execute($dto);
        if ($user) {
            $response->getBody()->write('');
            return $response->withStatus(204);
        }
        $response->getBody()->write(json_encode(['message' => 'usuario nao encontrado']));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
}
