<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

class HomeController 
{
    public function index()
    {
        echo "Hello World!";
    }
}