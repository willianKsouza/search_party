<?php

namespace App\Http\Users;

use Exception;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\DTO\Users\DeleteUserDTO;
use App\Interfaces\Users\Services\IDeleteUserService;

class DeleteUserController
{
    public function __construct(private IDeleteUserService $deleteUserService) {}
    public function delete(Request $request, Response $response, array $args)
    {
        try {
            $dto = new DeleteUserDTO($args['id']);
            $this->deleteUserService->execute($dto);
            return $response->withStatus(204)->withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            if ($e->getMessage() === "usuario nao encontrado") {
                $response->getBody()->write(json_encode(['sucess' => false, 'message' => $e->getMessage()]));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }
            $response->getBody()->write(json_encode(['sucess' => false, 'error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json');
        }
    }
}
