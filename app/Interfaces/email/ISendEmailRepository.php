<?php

namespace App\Interfaces\email;

use App\DTO\Users\ForgotPasswordDTO;

interface ISendEmailRepository
{
    public function send(ForgotPasswordDTO $dto);
}
