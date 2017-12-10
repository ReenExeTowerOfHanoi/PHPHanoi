<?php

namespace Tests;

use ReenExe\Hanoi\BreadthFirstSearch;
use ReenExe\Hanoi\State;
use ReenExe\Hanoi\Tower;

class BreadthFirstSearchTestCase extends AbstractSearchTestCase
{
    public function test()
    {
        $disks = range($this->size, 1);

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

        $breadthFirstSearch = new BreadthFirstSearch($beginState, $endState);

        $this->assertTrue($breadthFirstSearch->solve());
        $this->assertSame(4197, $breadthFirstSearch->getCount());

        $this->renderResult($breadthFirstSearch, 'breadthFirstSearchOutput.txt');

        $this->assertMoveLogList($breadthFirstSearch, $beginState, $endState);
    }
}
