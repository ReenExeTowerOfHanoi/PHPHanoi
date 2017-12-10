<?php

namespace Tests;

use ReenExe\Hanoi\BreadthFirstSearch;

class BreadthFirstSearchTestCase extends AbstractSearchTestCase
{
    public function test()
    {
        list($beginState, $endState) = $this->getStateRange();

        $breadthFirstSearch = new BreadthFirstSearch($beginState, $endState);

        $this->assertTrue($breadthFirstSearch->solve());
        $this->assertSame(4197, $breadthFirstSearch->getCount());

        $this->renderResult($breadthFirstSearch, 'breadthFirstSearchOutput.txt');

        $this->assertMoveLogList($breadthFirstSearch, $beginState, $endState);
    }
}
