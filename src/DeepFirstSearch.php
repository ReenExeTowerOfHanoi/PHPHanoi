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
     * @var array
     */
    private $pastStateList = [];

    /**
     * @var MoveLog[]
     */
    private $moveLogList = [];

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

    public function solve()
    {
        return $this->solveRecursive($this->beginState, 0, 1);
    }

    public function solveRecursive(State $currentState, int $level, int $count)
    {
        if ($currentState->getHash() === $this->endState->getHash()) {
            return true;
        }

        $possibleEndSteps = $this->getPossibleEndSteps($currentState);

        foreach ($possibleEndSteps as $possibleEndStep) {
            $possibleEndState = $possibleEndStep->getState();
            if (in_array($possibleEndState->getHash(), $this->pastStateList)) {
                continue;
            }

            $this->pastStateList[] = $possibleEndState->getHash();
            $this->moveLogList[] = $possibleEndStep->getMoveLog();

            $result = $this->solveRecursive($possibleEndState, $level + 1, $count + 1);

            if ($result === true) {
                return true;
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
}
