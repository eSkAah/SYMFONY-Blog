<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HelloController{

/**
 * @route("/hello")
 */
  public function hello():Response{
    return new Response("Hello World");
  }

/**
 * @route("/hello/{name}")
 */
  public function helloName($name):Response{
    return new Response('Hello '.$name);
  }

}