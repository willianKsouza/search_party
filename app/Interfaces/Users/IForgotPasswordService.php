<?php
namespace App\Interfaces\Users;



use App\DTO\Users\ForgotPasswordDTO;

interface IForgotPasswordService
{
    public function execute(ForgotPasswordDTO $dto);
}
