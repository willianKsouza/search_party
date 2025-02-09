<?php

namespace App\Services\Users;

use Exception;
use App\DTO\Users\UpdateUserDTO;
use App\Exceptions\UserNotFoundException;
use App\Interfaces\Users\Services\IUpdateUserService;
use App\Interfaces\Users\Repository\IUpdateUsersRepository;

class UpdateUserService implements IUpdateUserService
{
    public function __construct(private IUpdateUsersRepository $updateUsersRepository) {}
    public function execute(UpdateUserDTO $dto) {
        try {
            foreach ($dto->params as $field => $value) {
                if (preg_match('/^[a-zA-Z0-9_]+$/', $field)) {
                    $dto->sqlFields[] = "{$field} = :$field";
                }
            }
            $dto->params['id_user'] = $dto->idUser;
            $user = $this->updateUsersRepository->update($dto);
            if (empty($user)) {
                return throw new UserNotFoundException("usuario nao encontrado", 404);
            }
            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            
        }
    }
}
