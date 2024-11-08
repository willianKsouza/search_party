<?php

namespace App\Repository\Users;

use App\Config\Database;
use App\DTO\CreateUserDTO;
use App\Interfaces\ICreateUser;
use Exception;
use PDOException;

class CreateUserRepository implements ICreateUser
{
    public function create(CreateUserDTO $dto): bool
    {
        try {
            $sql = "INSERT INTO users (email, password, username, bio, created_at)
            VALUES (:email, :password, :username, :bio, NOW())";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->bindParam(':email', $dto->email);
            $stmt->bindParam(':password', $dto->password);
            $stmt->bindParam(':username', $dto->username);
            $stmt->bindParam(':bio', $dto->bio);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                if (preg_match('/users\.username/', $e->getMessage())) {
                    throw new Exception("O username já está cadastrado");
                } else {
                    throw new Exception("O email já está cadastrado");
                }
            }
            throw new Exception("erro ao cadastrar o usuario");
        }
    }
}
