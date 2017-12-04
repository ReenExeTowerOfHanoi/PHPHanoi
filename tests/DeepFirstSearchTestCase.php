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
        $disks = range(7 , 1);

        /**
         * Буквенные обозначения только для красоты
         */
        $beginState = new State([
            // B is BEGIN
            'B' => new Tower($disks),
            'X' => new Tower([]),
            'Y' => new Tower([]),
            // E is End
            'E' => new Tower([]),
        ]);

        $endState = new State([
            'B' => new Tower([]),
            'X' => new Tower([]),
            'Y' => new Tower([]),
            'E' => new Tower($disks),
        ]);

        $deepFirstSearch = new DeepFirstSearch($beginState, $endState);

        $this->assertTrue($deepFirstSearch->solve());
        $this->assertSame(11353, $deepFirstSearch->getCount());

        echo 'Move History:' . \PHP_EOL;
        foreach ($deepFirstSearch->getMoveLogList() as $moveLog) {
            echo $moveLog->toString() . \PHP_EOL;
        }

        echo 'Move count between towers: ' . count($deepFirstSearch->getMoveLogList()) . \PHP_EOL;
        echo 'Some algorithm count: ' . $deepFirstSearch->getCount() . \PHP_EOL;
    }
}