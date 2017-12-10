<?php

namespace Tests;

use ReenExe\Hanoi\BreadthFirstSearch;
use ReenExe\Hanoi\HeuristicFirstSearch;
use ReenExe\Hanoi\State;
use ReenExe\Hanoi\Tower;

class HeuristicFirstSearchTest extends AbstractSearchTestCase
{
    public function test()
    {
        list($beginState, $endState) = $this->getStateRange();

        $intermediateStates = [];

        if ($this->size > 3) {
            $intermediateStates = [
                new State([
                    'B' => new Tower(range($this->size - 3, 1)),
                    'X' => new Tower([$this->size - 2]),
                    'Y' => new Tower([$this->size - 1]),
                    'E' => new Tower([$this->size]),
                ])
            ];
        }

        $heuristicFirstSearch = new HeuristicFirstSearch(
            $beginState,
            $endState,
            BreadthFirstSearch::class,
            $intermediateStates
        );

        $this->assertTrue($heuristicFirstSearch->solve());
        $this->assertSame(18388, $heuristicFirstSearch->getCount());

        $this->renderResult($heuristicFirstSearch, 'heuristicFirstSearchOutput.txt');

        $this->assertMoveLogList($heuristicFirstSearch, $beginState, $endState);
    }
}
