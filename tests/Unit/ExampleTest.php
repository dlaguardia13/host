<?php

namespace Tests\Unit;

use App\Http\Controllers\PetsController;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

   /*public function testunitTest1()
    {
        $init = "Canino";
        $num = "777";
        $pet = new PetsController();
        $expec = $pet->generateUniqueCode($init,$num);

        $this->assertEquals("CAN-777",$expec);
    }

    public function testunitTest2()
    {
        $init = "Felino";
        $num = "102";
        $pet = new PetsController();
        $expec = $pet->generateUniqueCode($init,$num);
        $this->assertEquals("FELL-102",$expec);
    }

    public function testunitTest3()
    {
        $init = "Canino";
        $num = "999";
        $pet = new PetsController();
        $expec = $pet->generateUniqueCode($init,$num);
        $this->assertEqualsIgnoringCase("CAN-999",$expec);
    }*/
}
