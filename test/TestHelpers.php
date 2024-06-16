<?php

use PHPUnit\Framework\TestCase;

require_once './helper.php';

class TestHelpers extends TestCase
{
    function testFormattedPrice()
    {
        $price = 10;
        $this->assertEquals('€10,00', formatPrice($price));
        $price = 1000000;
        $this->assertEquals('€1.000.000,00', formatPrice($price));
    }



    function testSanatizeData()
    {
        $dirtyDataWhiteSpaces = "   test";
        $this->assertEquals('test', sanatizeData($dirtyDataWhiteSpaces));
    }


    function testFormatDate()
    {
        $date = '2021-10-10';
        $this->assertEquals('10-10-2021', formateDate($date));
    }
}
