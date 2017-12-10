<?php

namespace Tests;

use ReenExe\Hanoi\DeepFirstSearch;

class DeepFirstSearchTestCase extends AbstractSearchTestCase
{
    public function test()
    {
        list($beginState, $endState) = $this->getStateRange();

        $deepFirstSearch = new DeepFirstSearch($beginState, $endState);

        $this->assertTrue($deepFirstSearch->solve());
        $this->assertSame(10884, $deepFirstSearch->getCount());

        $this->renderResult($deepFirstSearch, 'deepFirstSearchOutput.txt');

        $this->assertMoveLogList($deepFirstSearch, $beginState, $endState);
    }
}
