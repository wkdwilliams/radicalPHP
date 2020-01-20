<?php

namespace App\Models;

use PDO;
use \Core\Model;

class User extends Model
{

    public static function getAll()
    {
        $stmt = static::getDB()->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
