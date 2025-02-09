<?php

namespace App\Interfaces\Users\Repository;

interface IFindUserByIdRepository
{
    function findById(string $id);
}
