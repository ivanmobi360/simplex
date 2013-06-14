<?php 
namespace Simplex;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StringResponseListener implements EventSubscriberInterface
{
    
    function onView(GetResponseForControllerResultEvent $event)
    {
        $response = $event->getControllerResult();
        
        if(is_string($response)){
            $event->setResponse(new Response($response));
        }
        
    }
    
	public static function getSubscribedEvents ()
    {
        return array('kernel.view' => 'onView');
    }

    
}