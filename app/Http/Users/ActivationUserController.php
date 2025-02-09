<?php

namespace App\Http\Users;

use App\DTO\Users\ActivationUserDTO;
use App\Services\Users\ActivationUserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

class ActivationUserController
{
    function __construct(private ActivationUserService $activationUserService) {}
    public function activateAccount(Request $request, Response $response, array $args)
    {
        try {
            $id = $args['id'];
            $dto = new ActivationUserDTO();
            $dto->id = $id;
            $userActivation = $this->activationUserService->execute($dto);
            $response->getBody()->write($userActivation ? 'true' : 'false');
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['sucess' => false, 'message' => $e->getMessage()]));
            return $response->withStatus($e->getCode() > 0 ? $e->getCode() : 500)->withHeader('Content-Type', 'application/json');
        }
    }
}
