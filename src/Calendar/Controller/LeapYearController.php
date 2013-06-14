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
            return 'The year is leap ';
        }else{
            return 'Nope, the year is not leap '; 
        }

    }
}