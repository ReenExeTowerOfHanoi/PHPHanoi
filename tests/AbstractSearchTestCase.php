<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReenExe\Hanoi\CommonStateSearcher;

abstract class AbstractSearchTestCase extends TestCase
{
    /**
     * @param CommonStateSearcher $stateSearcher
     * @param $fileName
     */
    protected function renderResult(CommonStateSearcher $stateSearcher, $fileName)
    {
        // Операция "." точка это добавление строк
        // PHP_EOL -> "\n" переход на новую строку
        $output = '4 Towers and 7 disks' . \PHP_EOL
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
}
