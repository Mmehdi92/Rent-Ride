<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class UnitTestSample extends TestCase{
public function testSom(){
    $x =1;
    $y = 2;

    $result = $x + $y;
    $this->assertEquals(3, $result);
}
}