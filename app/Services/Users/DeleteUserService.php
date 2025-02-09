<?php

namespace App\Services\Users;

use App\DTO\Users\DeleteUserDTO;
use App\Exceptions\UserNotFoundException;
use App\Interfaces\Users\Repository\IDeleteUserRepository;
use App\Interfaces\Users\Repository\IFindUserByIdRepository;
use App\Interfaces\Users\Services\IDeleteUserService;
use Exception;

class DeleteUserService implements IDeleteUserService
{
    public function __construct(private IDeleteUserRepository $deleteUserRepository, private IFindUserByIdRepository $findUserByIdRepository){}
    public function execute(DeleteUserDTO $dto)
    {   
        try {
            $user = $this->findUserByIdRepository->findById($dto->id);
            if (empty($user)) {
                return throw new UserNotFoundException("usuario nao encontrado", 404);
            }
            return $this->deleteUserRepository->delete($dto);
        } catch (Exception $e) {
            return throw new Exception($e->getMessage());
        }
    }
}
