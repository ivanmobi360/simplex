<?php


use Symfony\Component\DependencyInjection\Reference;

//use Symfony\Component\HttpKernel\HttpCache\Store;
//use Symfony\Component\HttpKernel\HttpCache\HttpCache;

require_once __DIR__ . '/../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


function render_template(Request $request)
{
    extract($request->attributes->all());
    ob_start();
    include __DIR__ . '/../src/pages/' . $_route . '.php' ;
    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();

$routes = include __DIR__ . '/../src/app.php';
$sc = include __DIR__ . '/../src/container.php';
//$framework = new HttpCache($framework, new Store(__DIR__ .'/../cache'));

$sc->setParameter('charset', 'UTF-8');

$sc->register('listener.string_response', 'Simplex\StringResponseListener');
$sc->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_response')));

$response = $sc->get('framework')->handle($request);

$response->send();
