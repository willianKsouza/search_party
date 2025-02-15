<?php
namespace App\Services\Posts;

use Exception;

use App\DTO\Posts\CreatePostDTO;
use App\Interfaces\Posts\ICreatePostRepository;
use App\Repository\Posts\FindPostByExactTitleRepository;

class CreatePostService
{

    public function __construct(private ICreatePostRepository $createPostRepository, private FindPostByExactTitleRepository $findPostByExactTitleRepository)
    {

    }
    public function create(CreatePostDTO $createPostDTO)
    {
        try {

            $createPostDTO->title = strtolower($createPostDTO->title);
            $titleExists = $this->findPostByExactTitleRepository->findByTitle($createPostDTO->title);
            if ($titleExists) {
                throw new Exception('ja existe um post com esse titulo');
            }
            $this->createPostRepository->create($createPostDTO);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
// procuro equipe de dota
// procuro equipe de league of legends
// procuro equipe de CS GO
// estou juntando grupo para monster hunter