<?php

namespace ReenExe\Hanoi;

class DeepFirstSearch extends CommonStateSearcher
{
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
