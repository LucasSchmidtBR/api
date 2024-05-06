<?php 

namespace App\Models;

require_once __DIR__."/../../config.php";

use PDO;

class Database 
{
  
    public static function getConnection()
    {

        $pdo = new PDO(
          "mysql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASS
        );
        return $pdo;

    }
}
