<?php

namespace App\Services\Users;

use Exception;
use App\DTO\Users\ForgotPasswordDTO;
use App\Interfaces\email\IMailerImplementation;
use App\Interfaces\email\ISendForgottenPasswordEmailRepository;
use App\Interfaces\ItempleteEngine;
use App\Interfaces\Users\IFindUserByEmailRepository;
use App\Interfaces\Users\IForgotPasswordService;

class ForgotPasswordService implements IForgotPasswordService
{
    public function __construct(private ISendForgottenPasswordEmailRepository $sendForgottenPasswordEmailRepository, private IFindUserByEmailRepository $FindUserByEmailRepository, ) {}
    
    public function execute(ForgotPasswordDTO $dto)
    {
        try {
            $findByEmail = $this->FindUserByEmailRepository->findByEmail($dto->email);
            if (!empty($findByEmail)) {
                $dto->username = $findByEmail['username'];
                $dto->id = $findByEmail['id_user'];
                return $this->sendForgottenPasswordEmailRepository->send($dto);
            }
            return throw new Exception("usuario nao encontrado");;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
