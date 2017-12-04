<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReenExe\Hanoi\Tower;

class TowerTestCase extends TestCase
{
    public function testEmpty()
    {
        $tower = new Tower([]);

        $this->assertTrue($tower->isEmpty());
    }

    public function testFilled()
    {
        $tower = new Tower([2, 3, 4]);

        $this->assertFalse($tower->isEmpty());

        $this->assertSame(3, $tower->getSize());

        $this->assertSame(2, $tower->getTop());
    }
}
