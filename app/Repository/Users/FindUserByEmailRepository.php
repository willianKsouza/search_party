<?php

namespace App\Repository\Users;

use App\Config\Database;

use PDOException;

class FindUserByEmailRepository
{
    public function login(string $email)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
