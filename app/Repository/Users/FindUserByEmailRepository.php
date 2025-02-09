<?php

namespace App\Repository\Users;

use Exception;
use PDOException;

use App\Config\Database;
use App\DTO\Users\AuthDTO;
use App\Interfaces\Users\IFindUserByEmailRepository;


class FindUserByEmailRepository implements IFindUserByEmailRepository
{
    public function findByEmail(string|AuthDTO $data)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->execute([':email' => $data]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());

        }
    }
}
