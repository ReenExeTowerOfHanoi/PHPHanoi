<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReenExe\Hanoi\CommonStateSearcher;
use ReenExe\Hanoi\MoveLog;
use ReenExe\Hanoi\State;

abstract class AbstractSearchTestCase extends TestCase
{
    protected $size = 7;

    /**
     * @param CommonStateSearcher $stateSearcher
     * @param $fileName
     */
    protected function renderResult(CommonStateSearcher $stateSearcher, $fileName)
    {
        // Операция "." точка это добавление строк
        // PHP_EOL -> "\n" переход на новую строку
        $output = "4 Towers and {$this->size} disks" . \PHP_EOL
            . 'Move History:' . \PHP_EOL;
        foreach ($stateSearcher->getMoveLogList() as $moveLog) {
            $output .= $moveLog->toString() . \PHP_EOL;
        }

        $output .= 'Move count between towers: '
            . count($stateSearcher->getMoveLogList())
            . ' (history length or steps) '
            . \PHP_EOL
            . 'Some algorithm count: ' . $stateSearcher->getCount() . \PHP_EOL
            . 'Good luck :)';

        // Запись строки в файл
        file_put_contents($fileName, $output);
    }

    protected function assertMoveLogList(CommonStateSearcher $stateSearcher, State $beginState, State $endState)
    {
        foreach ($stateSearcher->getMoveLogList() as $moveLog) {
            $this->assertMove($beginState, $moveLog);
        }

        $this->assertSame($beginState->getHash(), $endState->getHash());
    }

    private function assertMove(State $state, MoveLog $log)
    {
        $this->assertTrue($state->canMoveBetween($log->getFrom(), $log->getTo()));
        $this->assertSame($log->getDisk(), $state->move($log->getFrom(), $log->getTo()));
    }
}
