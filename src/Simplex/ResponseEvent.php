<?php 
namespace Simplex;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event
{
    private $request;
    private $response;
    
    function __construct(Response $response, Request $request)
    {
        $this->response = $response;
        $this->request = $request;
    }
    
    /**
     * @return Request
     */
    function getRequest(){
        return $this->request;
    }
    
    /**
     * @return Response
     */
    function getResponse(){
        return $this->response;
    }
    
}