<?php

namespace App\Repository\Posts;

use Exception;
use PDOException;

use App\Config\Database;
use App\DTO\Posts\CreatePostDTO;
use App\Interfaces\Posts\ICreatePostRepository;

class CreatePostRepository implements ICreatePostRepository
{
    public function create(CreatePostDTO $dto): bool
    {
        try {
            $dado = $dto;
            $sql = "INSERT INTO posts (title, body, id_user, created_at)
            VALUES (:title, :body, :id_user, NOW())";
            $stmt = Database::getInstance()->prepare($sql);
            return $stmt->execute([
                ':title' => $dto->title,
                ':body' => $dto->body,
                ':id_user' => $dto->idUser
            ]);
           
        } catch (PDOException $e) {
            if ($e->getCode() === 23000) {
                throw new Exception("ID do usuario nao existe");
            }
            throw new Exception("erro ao criar o post");
        }
    }
}
