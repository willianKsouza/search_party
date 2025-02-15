<?php

namespace App\Http\Posts;

use App\DTO\Posts\CreatePostDTO;
use App\Services\Posts\CreatePostService;
use Exception;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreatePostController
{
  public function __construct(private CreatePostService $createPostService) {}

  public function create(Request $request, Response $response, array $args)
  {


    try {

      $params = (array)$request->getParsedBody();
      $dto = new CreatePostDTO(
        $params['title'],
        $params['body'],
        $params['id_user'],
      );
      $this->createPostService->create($dto);
      $response->getBody()->write('');
      return $response->withStatus(204);
    } catch (Exception $e) {
      $payload = json_encode(['success' => false, 'error' => $e->getMessage()]);
      $response->getBody()->write($payload);
      return $response->withStatus(302);
    }
  }
}
