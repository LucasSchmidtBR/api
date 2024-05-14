<?php 

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
header('Access-Control-Allow-Origin: *');

class NotFoundController
{
    public function index(Request $request, Response $response)
    {
        $response::json([
            'error'   => true,
            'success' => false,
            'message' => 'Sorry, route not found.'
        ], 404);
        return;
    }
}