<?php

namespace App\Tests\Calculator;

use App\Calculator\CalculatorInterface;
use App\Model\Change;
use App\Calculator\Mk1Calculator;
use PHPUnit\Framework\TestCase;

class Mk1CalculatorTest extends TestCase
{
    /**
     * @var CalculatorInterface
     */
    private $calculator;

    protected function setUp()
    {
        $this->calculator = new Mk1Calculator();
    }

    public function testGetChangeEasy()
    {
        $change = $this->calculator->getChange(2);
        $this->assertInstanceOf(Change::class, $change);
        $this->assertEquals(2, $change->coin1);
    }

    public function testGetSupportedModel()
    {
        $this->assertEquals('mk1', $this->calculator->getSupportedModel());
    }
}