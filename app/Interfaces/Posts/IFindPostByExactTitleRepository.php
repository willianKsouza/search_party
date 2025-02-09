<?php

namespace App\Interfaces\Posts;

interface IFindPostByExactTitleRepository
{
    public function findByTitle(string $title);
}
