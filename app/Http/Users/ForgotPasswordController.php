<?php

namespace App\Http\Users;

use App\Interfaces\Posts\IForgotPasswordService;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class ForgotPasswordController 
{
    public function __construct(private IForgotPasswordService $forgotPasswordService) {}
    public function send(Request $request, Response $response, array $args){
        try{
            
            $this->forgotPasswordService->forgotPassword();
            $response->getBody()->write('');
            return $response;

        }catch(Exception $e){
            $response->getBody()->write(json_encode(['sucess' => false, 'error' => $e->getMessage()]));
            return $response;
        }
    }
}
