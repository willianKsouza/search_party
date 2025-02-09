<?php

namespace App\Migrations;

require __DIR__ . '../../../vendor/autoload.php';

use App\Config\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Add_field_active_users_table
{
    public static function up()
    {
        $db = Database::getInstance();
        $sql = "ALTER TABLE users ADD COLUMN active TINYINT(1) DEFAULT 1";
        $db->exec($sql);
    }

    public static function down()
    {
        $db = Database::getInstance();
        $sql = "ALTER TABLE users DROP COLUMN active;";
        $db->exec($sql);
    }
}

// CreateUsersTableMigration::up();
// CreateUsersTableMigration::down();