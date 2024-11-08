<?php

namespace App\DTO;

class CreatePostDTO
{
    public string $title;
    public string $body;
    public string $idUser;

    public function __construct(string $title, string $body, string $idUser)
    {
        $this->title = $title;
        $this->body = $body;
        $this->idUser = $idUser;
    }
}
