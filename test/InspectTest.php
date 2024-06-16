<?php
 
use PHPUnit\Framework\TestCase;
require_once 'c\laragon\RentAndRideWebApp\helper.php';

 
class InspectTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testInspect()
    {
        // Capture output of inspect function
        ob_start();
        inspect('Hello, PHPUnit!');
        $output = ob_get_clean();
 
        // Assert that output contains <pre> tags and the dumped value
        $this->assertStringContainsString('<pre>', $output);
        $this->assertStringContainsString('string(15) "Hello, PHPUnit!"', $output); // Adjust based on your PHP version output
 
        // Assert closing </pre> tag
        $this->assertStringContainsString('</pre>', $output);
    }
}
 