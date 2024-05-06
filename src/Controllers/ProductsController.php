<?php

namespace App\Controllers;


use App\Http\Request;
use App\Http\Response;
use App\Services\ProductService;

class ProductsController
{

    public function index(Request $request, Response $response){
        $body = $request::body();
        // print_r($body);

        $productService = ProductService::create($body);
        
        if (isset($productService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $productService
            ], 400);
        }

        $product = ProductService::showProduct($body['sku']);

        // return $product;
        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $product
        ], 201);
    }


    public function show(Request $request, Response $response)
    {

        $productService = ProductService::showProducts();

        if (isset($productService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $productService
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $productService
        ], 201);
    }
}