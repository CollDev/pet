<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateTimeTest
 *
 * @author Administrator
 */
namespace Sistema\Tests\Utils\Date;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    public function testNextDayDate()
    {
        $dateTime = \DateTime();
        $date = $dateTime->format('Y-m-d');
        $nextDayDate = date('Y-m-d', strtotime('+1 day', strtotime($date)));
        
        
    }
}

?>
