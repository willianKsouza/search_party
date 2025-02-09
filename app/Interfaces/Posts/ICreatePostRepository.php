<?php
namespace App\Interfaces\Posts;



use App\DTO\CreatePostDTO;

interface ICreatePostRepository
{
    public function create(CreatePostDTO $createPostDTO);
}
