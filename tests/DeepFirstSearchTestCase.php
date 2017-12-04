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

        $this->assertSame(11353, $deepFirstSearch->solve());

        // PHP_EOL -> "\n" переход на новую строку
        $output = '';
        $output .= '4 Towers and 7 disks' . \PHP_EOL;
        $output .= 'Move History:' . \PHP_EOL;
        foreach ($deepFirstSearch->getMoveLogList() as $moveLog) {
            $output .= $moveLog->toString() . \PHP_EOL;
        }

        $output .= 'Move count between towers: '
            . count($deepFirstSearch->getMoveLogList())
            . ' (history length or steps) '
            . \PHP_EOL;
        $output .= 'Some algorithm count: ' . $deepFirstSearch->getCount() . \PHP_EOL;

        $output .= 'Good luck :)';

        file_put_contents('output', $output);
    }
}