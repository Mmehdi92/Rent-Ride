// Bestand: tests/BasePathTest.php
<?php

use Framework\Valadation;
use PHPUnit\Framework\TestCase;

require_once './helper.php'; // Aanpassen aan de locatie van helper.php

class ValidationClassTest extends TestCase
{
    public function testString()
    {
        // test of de string  een value heeft
        $testString = "test";

        $this->assertEquals(true, Valadation::string($testString));
    }


    public function testStringCharacterLengthMin()
    {
        // test of de string  een een minimaal lengte heeft van 4 characters
        $testString = "test";
        $this->assertEquals(false, Valadation::string($testString, 5, 10));
        // test of de string  meer dan 10 characters heeft
        $testString = "Deze string heeft meer dan 10 chars";
        $this->assertEquals(false, Valadation::string($testString, 5, 10));

        // test of de string  een minimaal lengte heeft van 3 characters
        //en minder dan 10 characters
        $testString = "jaa";
        $this->assertEquals(true, Valadation::string($testString, 3, 10));


        // test pf de string een minimaal lengte heeft van 5 characters
        //en minder dan 10 characters
        $testString = "Valentina";
        $this->assertEquals(true, Valadation::string($testString, 5, 10));
    }


    public function testEmailValidaiton()
    {
        // test of de email een valid email is
        $testEmail = "valid@gmail.com";
        $testUnvalidEmail = "invalid@.com";

        $this->assertEquals(true, Valadation::email($testEmail));
        $this->assertEquals(false, Valadation::email($testUnvalidEmail));
    }


    public function match2Values()
    {
        // test of de 2 values gelijk zijn

        // case 1
        //include de white space om de trim function  binnen de match function te testen
        $valueOne = "   test";
        $valueTwo = "test";

        //expected true omdat de values gelijk zijn
        $this->assertEquals(true, Valadation::match($valueOne, $valueTwo));

        // case 2
        $valueOne = "test";
        $valueTwo = "mustfail";

        // expected false omdat de values niet gelijk zijn
        $this->assertEquals(false, Valadation::match($valueOne, $valueTwo));
    }
}
