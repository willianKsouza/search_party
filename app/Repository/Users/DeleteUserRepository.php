<?php

namespace App\Repository\Users;

use Exception;
use PDOException;
use App\Config\Database;
use App\DTO\Users\DeleteUserDTO;
use App\Interfaces\Users\Repository\IDeleteUserRepository;

class DeleteUserRepository implements IDeleteUserRepository
{
    public function delete(DeleteUserDTO $dto)
    {
        try {
            $sql = "DELETE FROM users WHERE id_user = :id_user";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->execute(['id_user' => $dto->id]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }  
    }
}
