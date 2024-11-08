<?php

namespace App\Migrations;

require __DIR__ . '../../../vendor/autoload.php';
use App\Config\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class CreateCommentsTableMigration
{
    public static function up()
    {
        $db = Database::getInstance();
        $sql = "CREATE TABLE comments (
    id_comment INT PRIMARY KEY AUTO_INCREMENT,
    comment_body TEXT,
    id_post INT,     -- Referencia o post no qual o comentário foi feito
    id_user INT, -- Referencia o usuário que fez o comentário
    FOREIGN KEY (id_post) REFERENCES posts(id_post),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);";
        $db->exec($sql);
    }

    public static function down()
    {
        $db = Database::getInstance();
        $sql = "DROP TABLE IF EXISTS comments";
        $db->exec($sql);
    }
}
// CreateCommentsTableMigration::up();
// CreateCommentsTableMigration::down();