<?php

namespace App\Migrations;
require __DIR__ . '../../../vendor/autoload.php';
use App\Config\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
class CreatePostTableMigration
{
    public static function up()
    {
        $db = Database::getInstance();
        $sql = "CREATE TABLE posts (
    id_post INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    body TEXT,
    id_user INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);";
        $db->exec($sql);
    }

    public static function down()
    {
        $db = Database::getInstance();
        $sql = "DROP TABLE IF EXISTS posts";
        $db->exec($sql);
    }
}

// CreatePostTableMigration::up();
// CreatePostTableMigration::down();
