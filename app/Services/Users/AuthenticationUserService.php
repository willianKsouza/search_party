<?php

namespace App\Services\Users;

use App\DTO\AuthDTO;
use App\DTO\UserDTO;
use App\Interfaces\IFindUserByEmailRepository;
use App\Repository\Users\FindUserByEmailRepository;
use Exception;


class AuthenticationUserService implements IFindUserByEmailRepository
{
    public function __construct(private FindUserByEmailRepository $findUserByEmailRepository) {}
    public function login(string|AuthDTO $data)
    {
        try {
            if (empty($data->email) || empty($data->password)) {
                return 'campo nao preenchido';
            }

            $user = $this->findUserByEmailRepository->login($data->email);
            if (password_verify($data->password, $user['password'])) {


                $user = new UserDTO($user['id_user'], $user['email'], $user['username'], $user['bio']);
                return $user;
            }else {
                return 'USUARIO NAO AUTENTICADO';
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
