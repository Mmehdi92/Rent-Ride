 <?php
use PHPUnit\Framework\TestCase;
 
require_once './helper.php'; 
class BasePathTest extends TestCase
{
    public function testBasePathWithoutArgument()
    {
     
        $expected =  "C:\laragon\RentAndRideWebApp/";
        $this->assertEquals($expected, basePath());
    }
 
    public function testBasePathWithPathArgument()
    {
        $expected = "C:\laragon\RentAndRideWebApp/test_path";
        $this->assertEquals($expected, basePath('test_path'));
    }
}
 