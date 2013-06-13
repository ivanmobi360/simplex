<?php 

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class LeapYearController{
    function indexAction($request){
        if(is_leap_year($request->attributes->get('year'))){
            return new Response('The year is leap');
        }
        return new Response('Nope, the year is not leap');
    }
}

function is_leap_year($year = null){
    if(null == $year){
        $year = date('Y');
    }
    
    return 0==$year%400 || ( 0==$year%4 && 0!=$year%100  );
    
}


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


$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
        'year' => null,
        '_controller' => array(new LeapYearController(), 'indexAction')
        )));

return $routes;