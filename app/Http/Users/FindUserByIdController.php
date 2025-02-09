<?php

namespace App\Http\Users;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\Users\FindUserByIdService;
use Exception;

class FindUserByIdController
{
    public function __construct(private FindUserByIdService $findUserByIdService) {}
    public function findById(Request $request, Response $response, array $args){
        try {
            $id = $args['id'];
            $user =  $this->findUserByIdService->execute($id);
            if($user) {
                $response->getBody()->write(json_encode(['user' => $user]));
               return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
            }
        } catch (Exception $e) {
            return $response->withStatus($e->getCode() > 0 ? $e->getCode() : 500)->withHeader('Content-Type', 'application/json');
        }
    }
}
