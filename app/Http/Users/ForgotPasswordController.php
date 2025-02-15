<?php

namespace App\Http\Users;

use Exception;


use App\DTO\Users\ForgotPasswordDTO;
use App\Interfaces\Users\IForgotPasswordService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ForgotPasswordController 
{
    public function __construct(private IForgotPasswordService $forgotPasswordService) {}
    public function send(Request $request, Response $response, array $args){
        try{
            $params = (array)$request->getParsedBody();
            $dto = new ForgotPasswordDTO();
            $dto->email = $params['email'];
            $email = $this->forgotPasswordService->execute($dto);
            $response->getBody()->write('');
            return $response->withStatus(204);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['message' => $e->getMessage()]));
            return $response->withStatus($e->getCode() > 0 ? $e->getCode() : 500)->withHeader('Content-Type', 'application/json');
        }
    }
}
