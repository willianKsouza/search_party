<?php
namespace App\Interfaces\Posts;



use App\DTO\Posts\CreatePostDTO;

interface ICreatePostRepository
{
    public function create(CreatePostDTO $createPostDTO);
}
