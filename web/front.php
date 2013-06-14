<?php
use Symfony\Component\HttpKernel\HttpCache\Store;

use Symfony\Component\HttpKernel\HttpCache\HttpCache;

use Simplex\ContentLengthListener;

use Simplex\GoogleListener;

use Symfony\Component\EventDispatcher\EventDispatcher;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

function render_template(Request $request)
{
    extract($request->attributes->all());
    ob_start();
    include __DIR__ . '/../src/pages/' . $_route . '.php' ;
    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();

$routes = include __DIR__ . '/../src/app.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);
$resolver = new ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new GoogleListener());
$dispatcher->addSubscriber(new ContentLengthListener());



$framework = new \Simplex\Framework($dispatcher, $matcher, $resolver);
$framework = new HttpCache($framework, new Store(__DIR__ .'/../cache'));
$response = $framework->handle($request);

$response->send();
