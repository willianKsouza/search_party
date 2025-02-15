<?php

namespace App\Http\Users;

use App\DTO\Users\UpdateUserDTO;
use App\Interfaces\Users\Services\IUpdateUserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

class UpdateUserController
{

    function __construct(private IUpdateUserService $updateUserService) {}
    public function update(Request $request, Response $response, array $args)
    {
        try {
            $params = $request->getParsedBody();
            $id = $args['id'];
            $dto = new UpdateUserDTO();
            $dto->idUser = $id;
            $dto->params = $params;
            $this->updateUserService->execute($dto);
            $response->getBody()->write('');
            return $response->withStatus(204);
        } catch (Exception $e) {
            if ($e->getMessage() === "usuario nao encontrado") {
                $response->getBody()->write(json_encode(['sucess' => false, 'message' => $e->getMessage()]));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }
            $response->getBody()->write(json_encode(['sucess' => false, 'message' => $e->getMessage()]));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }
    }
}
