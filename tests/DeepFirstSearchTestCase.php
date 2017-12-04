<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReenExe\Hanoi\DeepFirstSearch;
use ReenExe\Hanoi\State;
use ReenExe\Hanoi\Tower;

class DeepFirstSearchTestCase extends TestCase
{
    public function test()
    {
        $disks = [3, 2, 1];

        $beginState = new State([
            'A' => new Tower($disks),
            'B' => new Tower([]),
            'C' => new Tower([]),
        ]);

        $endState = new State([
            'A' => new Tower([]),
            'B' => new Tower([]),
            'C' => new Tower($disks),
        ]);

        $deepFirstSearch = new DeepFirstSearch($beginState, $endState);

        $this->assertTrue($deepFirstSearch->solve());

        foreach ($deepFirstSearch->getMoveLogList() as $moveLog) {
            echo $moveLog->toString() . \PHP_EOL;
        }
    }
}