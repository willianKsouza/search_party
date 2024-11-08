<?php

namespace App\Middlewares;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Response as  Psr7Response;
class CreatePostValidate
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $params = $request->getParsedBody();
        $erros = [];
        if (strlen($params['title']) < 3 || strlen($params['title']) > 50) {
            $erros['title'] = "Titulo inválido!";
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
