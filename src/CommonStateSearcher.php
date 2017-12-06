<?php

namespace ReenExe\Hanoi;

abstract class CommonStateSearcher
{
    /**
     * @var State
     */
    protected $beginState;

    /**
     * @var State
     */
    protected $endState;

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
    protected $pastStateMap = [];

    /**
     * @var MoveLog[]
     */
    protected $moveLogList = [];

    /**
     * @var int
     */
    protected $count = 0;

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

    protected function isEndState(State $state)
    {
        return $state->getHash() === $this->endState->getHash();
    }

    protected function isPastState(State $state)
    {
        // Проверяю по наличию ключа
        return isset($this->pastStateMap[$state->getHash()]);
    }

    protected function addPastState(State $state)
    {
        // Сохраняю чтобы использовать быстрый поиск по ключам
        $this->pastStateMap[$state->getHash()] = true;
    }

    /**
     * @param State $currentState
     * @return Step[]
     */
    protected function getPossibleEndSteps(State $currentState)
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
}
