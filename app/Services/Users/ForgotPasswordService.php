<?php

namespace App\Services\Users;

use Exception;
use App\DTO\Users\ForgotPasswordDTO;

use App\Interfaces\email\ISendEmailRepository;
use App\Interfaces\Users\IFindUserByEmailRepository;
use App\Interfaces\Users\IForgotPasswordService;

class ForgotPasswordService implements IForgotPasswordService
{
    public function __construct(private ISendEmailRepository $SendEmailRepository, private IFindUserByEmailRepository $FindUserByEmailRepository) {}

    public function execute(ForgotPasswordDTO $dto)
    {
        try {
            $findByEmail = $this->FindUserByEmailRepository->findByEmail($dto->email);
            if (empty($findByEmail)) {
                $dto->name = $findByEmail->name;
                $mail = $this->SendEmailRepository->send($dto);
                return $mail;
            }
            return throw new Exception("usuario nao encontrado");;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
