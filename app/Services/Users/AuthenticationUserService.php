<?php

namespace App\Services\Users;

use Exception;

use App\DTO\Users\AuthDTO;
use App\Interfaces\Users\IFindUserByEmailRepository;


class AuthenticationUserService
{
    public function __construct(private IFindUserByEmailRepository $findUserByEmailRepository) {}
    public function execute(string|AuthDTO $data)
    {
        try {
            if (empty($data->email) || empty($data->password)) {
                return throw new Exception('campo nao preenchido');
            }
            $user = $this->findUserByEmailRepository->findByEmail($data->email);
            if (password_verify($data->password, $user['password'])) {
                return $user;
            } else {
                return throw new Exception('usuario nao autenticado', 401);
            }
        } catch (Exception $e) {
            return throw new Exception($e->getMessage());
        }
    }
}
