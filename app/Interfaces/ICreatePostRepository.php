<?php

namespace App\Interfaces;

use App\DTO\CreatePostDTO;

interface ICreatePostRepository
{
    public function create(CreatePostDTO $createPostDTO);
}
