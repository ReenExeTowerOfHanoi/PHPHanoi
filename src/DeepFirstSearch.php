<?php

namespace ReenExe\Hanoi;

class DeepFirstSearch extends CommonStateSearcher
{
    /**
     * Флаг результат найден
     * @var
     */
    private $found = false;

    /**
     * @var array
     */
    private $reverseMoveLogList = [];

    public function solve(): bool
    {
        $this->solveRecursive($this->beginState, 0, 1);

        $this->moveLogList = array_reverse($this->reverseMoveLogList);

        return $this->found;
    }

    public function solveRecursive(State $currentState, int $level, int $count): int
    {
        if ($this->isEndState($currentState)) {
            $this->count = $count;
            $this->found = true;
            // Возвращаем 0 чтобы соответствовать возвращаемому типу
            return 0;
        }

        $possibleEndSteps = $this->getPossibleEndSteps($currentState);

        foreach ($possibleEndSteps as $possibleEndStep) {
            $possibleEndState = $possibleEndStep->getState();

            $result = $this->solveRecursive($possibleEndState, $level + 1, $count + 1);

            if ($this->found) {
                // Операция [] добавления в конец массива
                $this->reverseMoveLogList[] = $possibleEndStep->getMoveLog();
                // Возвращаем 0 чтобы соответствовать возвращаемому типу
                return 0;
            }

            $count = $result + 1;
        }

        return $count;
    }
}
