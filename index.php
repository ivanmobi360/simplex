<?php
require_once __DIR__ . '/autoload.php';


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$input = $request->get('name', 'World');

$response = new Response(
        sprintf("Hello %s", htmlspecialchars($input, ENT_QUOTES, 'UTF-8') )
        );
$response->setMaxAge(10);
$response->send();

echo "Ip: " . $request->getClientIp();
echo '<br><pre>'. $response;