<?php 

namespace App\Services;

use App\Http\JWT;
use App\Models\Products;
use App\Utils\Validator;
use Exception;
use PDOException;

header('Access-Control-Allow-Origin: *');
class ProductService
{
    public static function create(array $data)
    {

        try {
            $fields = Validator::validate([
                'sku' => $data['sku'] ?? '',
                'description' => $data['description'] ?? '',
                'price' => $data['price'] ?? '',
                'stock' => $data['stock'] ?? '',
                'category' => $data['category'] ?? '',
                'thumbnail' => $data['thumbnail'] ?? '',
                'status'=> $data['status'] ??'',

            ]);
            

            $products = Products::save($fields);
            if (!$products){
                throw new Exception('Sorry, product already exists.');
            }
            
            return $products;

        } 
        catch (PDOException $e) {
            
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, product already exists.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }


    public static function showProducts()
    {
        try {
            $products = Products::find();

            return $products;
        }
        catch (PDOException $e) {
            
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, product already exists.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    public static function showProduct($sku)
    {
        try {
            $product = Products::findOne($sku);
            // print_r($product);
            return $product;
        }
        catch (PDOException $e) {
            
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function deleteProduct($sku)
    {
        $product = Products::delete($sku);


        if(!$product) return ['error'=> 'Sorry, we could not delete.'];

        return "Produto deletado";
    }
}
