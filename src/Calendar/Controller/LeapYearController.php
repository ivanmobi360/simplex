<?php
namespace Calendar\Controller;
 
use Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LeapYearController
{
    function indexAction(Request $request, $year)
    {
        
        $lyear = new LeapYear();
        
        if ($lyear->is_leap_year($year)){
            $response = new Response('The year is leap ');
        }else{
            $response = new Response('Nope, the year is not leap ' . rand()); 
        }
        
        $response->setTtl(10);
        
        return $response;
    }
}