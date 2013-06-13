<?php 

namespace Simplex;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Framework
{
    protected $matcher;
    protected $resolver;
    
    public function __construct(UrlMatcher $matcher, ControllerResolver $resolver)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
    }
    
    public function handle(Request $request)
    {
        try {
            $request->attributes->add( $this->matcher->match($request->getPathInfo()) );
        
            $controller = $this->resolver->getController($request);
            $arguments = $this->resolver->getArguments($request, $controller);
        
            $response = call_user_func_array($controller, $arguments);
        } catch ( ResourceNotFoundException $e) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $e) {
            $response = new Response('An error ocurred <pre>' . $e->getTraceAsString()  , 500);
        }
        
        return $response;
    }
    
}