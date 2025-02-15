<?php

namespace App\Interfaces\email;
use App\DTO\Users\ForgotPasswordDTO;

interface ISendForgottenPasswordEmailRepository
{
    public function send(ForgotPasswordDTO $dto);
}
