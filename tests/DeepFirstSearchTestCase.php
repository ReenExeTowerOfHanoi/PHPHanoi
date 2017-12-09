<?php

namespace Tests;

use ReenExe\Hanoi\DeepFirstSearch;
use ReenExe\Hanoi\State;
use ReenExe\Hanoi\Tower;

class DeepFirstSearchTestCase extends AbstractSearchTestCase
{
    public function test()
    {
        $disks = range(7, 1);

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
        $this->assertSame(10884, $deepFirstSearch->getCount());

        $this->renderResult($deepFirstSearch, 'deepFirstSearchOutpur.txt');
    }
}
