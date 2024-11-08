<?php

namespace App\Middlewares;

use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Response as  Psr7Response;

class CreateUserValidate
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $params = $request->getParsedBody();
        $erros = [];
        if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
            $erros['email'] = "E-mail inválido!";
        }
        if (strlen($params['username']) < 3 || strlen($params['username']) > 50) {
            $erros['username'] = 'O Username deve ter entre 3 e 50 caracteres';
        }
        if (!empty($erros)) {
            $response = new Psr7Response();
            $response->getBody()->write(json_encode($erros));
            return $response->withStatus(400);
        } else {
            return $handler->handle($request);
        }
    }
}
