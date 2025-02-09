<?php

namespace App\Repository\Users;

use Exception;
use PDOException;
use App\Config\Database;
use App\Interfaces\Users\Repository\IFindUserByIdRepository;

class FindUserByIdRepository implements IFindUserByIdRepository
{
    public function findById(string $id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id_user = :id_user";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->bindParam(':id_user', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            
        }
    }
}
