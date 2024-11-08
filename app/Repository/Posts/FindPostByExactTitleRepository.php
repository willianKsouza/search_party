<?php

namespace App\Repository\Posts;

use App\Config\Database;
use PDOException;

class FindPostByExactTitleRepository
{
    public function findByTitle(string $title){
        try {
            $sql = "SELECT * FROM posts WHERE title = :title";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
