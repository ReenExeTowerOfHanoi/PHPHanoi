<?php

namespace ReenExe\Hanoi;

class DeepFirstSearch
{
    /**
     * @var State
     */
    private $beginState;

    /**
     * @var State
     */
    private $endState;

    /**
     * Массив строк
     * Это свойство для сохранения уже пройденных состояний
     * Чтобы состояния можна было сравнить они конвертируются в строки
     * Пример:
     *          "{"B":"[7,6,5,4,3,2]","X":"[1]","Y":"[]","E":"[]"}"
     * В других языкам можно использовать другие форматы для отображения состояния ввиде строки
     * Например очень просто написать что-то такое:
     *          "B:7,6,5,4,3,2,;"X":1,;Y:;E:;"
     * @var array
     */
    private $pastStateList = [];

    /**
     * @var MoveLog[]
     */
    private $moveLogList = [];

    /**
     * @var int
     */
    private $count;

    /**
     * Флаг результат найден
     * @var
     */
    private $found = false;

    /**
     * DeepFirstSearch constructor.
     * @param State $beginState
     * @param State $endState
     */
    public function __construct(State $beginState, State $endState)
    {
        $this->beginState = $beginState;
        $this->endState = $endState;
    }

    public function solve(): int
    {
        $this->solveRecursive($this->beginState, 0, 1);

        return $this->count;
    }

    public function solveRecursive(State $currentState, int $level, int $count): int
    {
        if ($currentState->getHash() === $this->endState->getHash()) {
            $this->count = $count;
            $this->found = true;
            // Возвращаем 0 чтобы соответствовать возвращаемому типу
            return 0;
        }

        $possibleEndSteps = $this->getPossibleEndSteps($currentState);

        foreach ($possibleEndSteps as $possibleEndStep) {
            $possibleEndState = $possibleEndStep->getState();
            // in_array проверяю что значение входит в массив
            // C# indexOf
            if (in_array($possibleEndState->getHash(), $this->pastStateList)) {
                continue;
            }

            // Операция [] добавления в конец массива
            $this->pastStateList[] = $possibleEndState->getHash();

            // Операция [] добавления в конец массива
            $this->moveLogList[] = $possibleEndStep->getMoveLog();

            $result = $this->solveRecursive($possibleEndState, $level + 1, $count + 1);

            if ($this->found) {
                // Возвращаем 0 чтобы соответствовать возвращаемому типу
                return 0;
            }

            $count = $result + 1;
        }

        return $count;
    }

    /**
     * @param State $currentState
     * @return Step[]
     */
    private function getPossibleEndSteps(State $currentState)
    {
        $fromNames = $currentState->getTowerNames();
        $toNames = $currentState->getTowerNames();

        $result = [];

        foreach ($fromNames as $fromTowerIndex) {
            foreach ($toNames as $toTowerIndex) {
                if ($fromTowerIndex !== $toTowerIndex) {
                    if ($currentState->canMoveBetween($fromTowerIndex, $toTowerIndex)) {
                        $possibleEndState = $currentState->clone();

                        $movedDisk = $possibleEndState->move($fromTowerIndex, $toTowerIndex);

                        // Операция [] добавления в конец массива
                        $result[] = new Step(
                            $possibleEndState,
                            new MoveLog(
                                $fromTowerIndex,
                                $toTowerIndex,
                                $movedDisk
                            )
                        );
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @return MoveLog[]
     */
    public function getMoveLogList(): array
    {
        return $this->moveLogList;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
