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
            $dto = new ForgotPasswordDTO($params['email'],'');
            
            $email = $this->forgotPasswordService->execute($dto);
            $response->getBody()->write('email enviado');
            return $response->withHeader('Content-Type', 'application/json');

        }catch(Exception $e){
            $response->getBody()->write(json_encode(['sucess' => false, 'error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json');
        }
    }
}
