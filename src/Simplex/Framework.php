<?php 
namespace Simplex;

use Symfony\Component\HttpKernel\HttpKernelInterface;

use Symfony\Component\EventDispatcher\EventDispatcher;

use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Request;


class Framework implements HttpKernelInterface
{
    protected $matcher;
    protected $resolver;
    protected $dispatcher;
    
    public function __construct(EventDispatcher $dispatcher, UrlMatcherInterface $matcher, ControllerResolverInterface $resolver)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
        $this->dispatcher = $dispatcher;
    }
    
    public function handle(Request $request, $type=HttpKernelInterface::MASTER_REQUEST, $catch = true)
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
        
        $this->dispatcher->dispatch('response', new ResponseEvent($response, $request));
        
        return $response;
    }
    
}