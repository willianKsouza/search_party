<?php
namespace App\Repository\Users;

use Exception;
use PDOException;
use App\Config\Database;
use App\DTO\Users\CreateUserDTO;
use App\Interfaces\Users\ICreateUserRepository;

class CreateUserRepository implements ICreateUserRepository
{
    public function create(CreateUserDTO $dto): string
    {
        try {
            $sql = "INSERT INTO users (email, password, username, bio, created_at)
            VALUES (:email, :password, :username, :bio, NOW())";
            $instance = Database::getInstance();
            $stmt = $instance->prepare($sql);

            $stmt->execute([
                ':email' => $dto->email,
                ':password' => $dto->password,
                ':username' => $dto->username,
                ':bio' => $dto->bio,
            ]);
            $lastId = $instance->lastInsertId();
         
            return $lastId;
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                if (preg_match('/users\.username/', $e->getMessage())) {
                    throw new PDOException("O username já está cadastrado");
                } else {
                    throw new PDOException("O email já está cadastrado");
                }
            }
            throw new Exception("erro ao cadastrar o usuario");
        }
    }
}
