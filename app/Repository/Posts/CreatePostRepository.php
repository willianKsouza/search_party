<?php

namespace App\Repository\Posts;

use App\Config\Database;
use App\DTO\CreatePostDTO;
use App\Interfaces\ICreatePostRepository;
use Exception;
use PDOException;

class CreatePostRepository implements ICreatePostRepository
{
    public function create(CreatePostDTO $dto): bool
    {
        try {
            $sql = "INSERT INTO posts (title, body, id_user, created_at)
            VALUES (:title, :body, :id_user, NOW())";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->bindParam(':title', $dto->title);
            $stmt->bindParam(':body', $dto->body);
            $stmt->bindParam(':id_user', $dto->idUser);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() === 23000) {
                throw new Exception("ID do usuario nao existe");
            }
            throw new Exception("erro ao criar o post");
        }
    }
}
