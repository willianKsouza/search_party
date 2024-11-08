<?php

namespace App\Services\Users;

use App\Interfaces\ISendEmailRepository;
use App\Interfaces\Posts\IForgotPasswordService;
use Exception;

class ForgotPasswordService implements IForgotPasswordService
{
    public function __construct(private ISendEmailRepository $SendEmailRepository) {}
    public function forgotPassword()
    {
        try {
            $mail = $this->SendEmailRepository->send();
            return $mail;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
