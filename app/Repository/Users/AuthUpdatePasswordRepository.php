<?php

namespace App\Repository\Users;

use App\Config\Database;
use App\DTO\Users\AuthUpdateDTO;
use App\Interfaces\Users\Repository\IAuthUpdatePasswordRepository;
use Exception;
use PDOException;

class AuthUpdatePasswordRepository implements IAuthUpdatePasswordRepository
{
    public function update(AuthUpdateDTO $dto)
    {
        try {
            $sql = "UPDATE users SET password = :password WHERE id_user = :id_user";
            $stmt = Database::getInstance()->prepare($sql);
            return $stmt->execute([
                'password' => $dto->password,
                'id_user' => $dto->idUser
            ]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
