<?php 

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', array(
        'name'=>'World',
        '_controller' => function (Request $request){
            return render_template($request);
        }
        )));

$routes->add('bye', new Route('/bye', array(
        '_controller' => 'render_template'
        )));


$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
        'year' => null,
        '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction'
        )));

return $routes;