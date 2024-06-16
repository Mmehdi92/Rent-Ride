<?php

use PHPUnit\Framework\TestCase;
use Framework\Session;

require_once './helper.php'; // Aanpassen aan de locatie van helper.php

class SessionTest extends TestCase
{

    public function testSessionSet()
    {
        // Values zijn niet gezet  in de sessie super global
        // dus de functie moet false returnen
        $this->assertEquals(false, Session::set('test', 'test'));
        //start de sessie
        Session::start();

        //set de values in de sessie super global
        Session::set('test', 'test');

        //check of de value in de sessie super global zit
        $this->assertEquals('test', Session::get('test'));
    }

    function testSessionHas(){
        //start de sessie
        Session::start();

        //set de values in de sessie super global
        Session::set('test', 'test');

        //check of de value in de sessie super global zit
        $this->assertEquals(true, Session::has('test'));
    }


    function testSessionClear(){
        //start de sessie
        Session::start();

        //set de values in de sessie super global
        Session::set('test', 'test');

        //check of de value in de sessie super global zit
        $this->assertEquals('test', Session::get('test'));

        //clear de value in de sessie super global
        Session::clear('test');

        //check of de value in de sessie super global zit
        $this->assertEquals(null, Session::get('test'));
    }
  
}
