<?php

namespace App\Interfaces;

interface IFindPostByExactTitleRepository
{
    public function findByTitle(string $title);
}
