<?php

namespace App\Repository\Posts;

use App\config\Database;
use PDOException;

class FindPostBySimilarTitleRepository
{
    public function findBySimilarTitle(string $title)
    {
        try {
            $sql = "SELECT * FROM posts WHERE title LIKE CONCAT('%', :title, '%');";
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
