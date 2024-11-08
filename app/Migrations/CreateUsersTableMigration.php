<?php

namespace App\Migrations;

require __DIR__ . '../../../vendor/autoload.php';

use App\Config\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class CreateUsersTableMigration
{
    public static function up()
    {
        $db = Database::getInstance();
        $sql = "CREATE TABLE users (
    id_user INTEGER PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
        $db->exec($sql);
    }

    public static function down()
    {
        $db = Database::getInstance();
        $sql = "DROP TABLE IF EXISTS users";
        $db->exec($sql);
    }
}

// CreateUsersTableMigration::up();
// CreateUsersTableMigration::down();
