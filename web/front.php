<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$map = array(
        '/hello' => 'hello',
        '/bye' => 'bye'
        ); 

$path = $request->getPathInfo();

if(isset($map[$path])){
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include __DIR__ . '/../src/pages/' . $map[$path] . '.php' ;
    $response = new Response(ob_get_clean());
}else{
    $response = new Response('Not Found', 404);
}


$response->send();
