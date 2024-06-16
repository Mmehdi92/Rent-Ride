<?php

use PHPUnit\Framework\TestCase;

require_once './helper.php';

class TestHelpers extends TestCase
{
    function testFormattedPrice()
    {// test of de prijs goed geformateerd is
        $price = 10;
        $this->assertEquals('€10,00', formatPrice($price));
        $price = 1000000;
        $this->assertEquals('€1.000.000,00', formatPrice($price));
    }



    function testSanatizeData()
    {
        // test of de variabele geen white spaces heeft
        $dirtyDataWhiteSpaces = "   test";
        $this->assertEquals('test', sanatizeData($dirtyDataWhiteSpaces));
    }


    function testFormatDate()
    {   
        // test of de datum goed geformateerd is
        $date = '2021-10-10';
        $this->assertEquals('10-10-2021', formateDate($date));
    }
}
