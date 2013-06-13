<?php 

use Symfony\Component\Routing\Route;

use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('hello', new Route('/hello/{name}', array(
        'name'=>'World',
        '_controller' => function ($request){
            return render_template($request);
        }
        )));

$routes->add('bye', new Route('/bye', array(
        '_controller' => 'render_template'
        )));

return $routes;