<?php
require_once __DIR__ . '/autoload.php';


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$response = new Response();

$map = array(
        '/hello' => __DIR__ . '/hello.php',
        '/bye' => __DIR__ . '/bye.php'
        ); 

$path = $request->getPathInfo();

if(isset($map[$path])){
    require $map[$path];
}else{
    $response->setStatusCode(404);
    $response->setContent('Not Found ' . $path);
}


$response->send();
