<?php 

namespace App\Models;

use App\Models\Database;
use PDO;

class Products extends Database
{

    
    public static function save(array $data)
    {
        $pdo = self::getConnection();


        $checkProducts = Products::find();

        foreach ($checkProducts as $key => $value){
            // return ($value["sku"] == $data["sku"]);
            if($value["sku"] == $data["sku"])
            {
                return false;
            }

        }
            $stmt = $pdo->prepare("
                INSERT 
                INTO 
                    test (sku, description, price, stock, category, thumbnail)
                VALUES
                    (?, ?, ?, ?, ?, ?)
                ");

            $stmt->execute([
                $data['sku'],
                $data['description'],
                $data['price'],
                $data['stock'],
                $data['category'],
                $data['thumbnail'],
            ]);

            return $pdo->lastInsertId() > 0 ? true : false;         
        

        
    }


    public static function findOne(int|string $sku)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare('
            SELECT
                id, sku, description, price, stock, category, thumbnail
            FROM
                test
            WHERE
                sku = ?
        ');

        $stmt->execute([$sku]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function find()
    {
        $pdo = self::getConnection();

        $stmt = $pdo->query('
            SELECT 
                *
            FROM 
                test
        ');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $array[] = $row;
        }

        return $array;
    }

    public static function update(int|string $id, array $data)
    {
        $pdo = self::getConnection();
        
        $stmt = $pdo->prepare('
            UPDATE 
                users
            SET 
                name = ?
            WHERE 
                id = ?
        ');

        $stmt->execute([$data['name'], $id]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function delete(int|string $sku)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            DELETE 
            FROM 
                test
            WHERE 
                sku = ?
        ');

        $stmt->execute([$sku]);

        return $stmt->rowCount() > 0 ? true : false;
    }
}