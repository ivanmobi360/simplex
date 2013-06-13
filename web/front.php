<?php
require_once __DIR__ . '/../src/autoload.php';


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$response = new Response();

$pages = __DIR__ . '/../src/pages/';
$map = array(
        '/hello' => $pages . '/hello.php',
        '/bye' => $pages . '/bye.php'
        ); 

$path = $request->getPathInfo();

if(isset($map[$path])){
    ob_start();
    include $map[$path];
    $response->setContent(ob_get_clean());
}else{
    $response->setStatusCode(404);
    $response->setContent('Not Found ' . $path);
}


$response->send();
