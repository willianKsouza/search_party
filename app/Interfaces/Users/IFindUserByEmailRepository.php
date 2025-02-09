<?php
namespace App\Interfaces\Users;



use App\DTO\Users\AuthDTO;

interface IFindUserByEmailRepository
{
    public function findByEmail(string|AuthDTO $data);
}
