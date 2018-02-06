<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function hello()
    {
        return new Response('Hello');
    }
}