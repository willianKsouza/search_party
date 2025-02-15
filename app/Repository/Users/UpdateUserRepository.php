<?php

namespace App\Repository\Users;

use Exception;
use PDOException;
use App\Config\Database;
use App\DTO\Users\UpdateUserDTO;
use App\Interfaces\Users\Repository\IUpdateUsersRepository;

class UpdateUserRepository implements IUpdateUsersRepository
{
    public function update(UpdateUserDTO $dto)
    {
        try {
            $sql = "UPDATE users SET " . implode(', ', $dto->sqlFields) . " WHERE id_user = :id_user";
            $stmt = Database::getInstance()->prepare($sql);
            $user = $stmt->execute($dto->params);
            return $user;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
