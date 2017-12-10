<?php

namespace ReenExe\Hanoi;

class BreadthFirstSearch extends CommonStateSearcher
{
    /**
     * @var Step[]
     */
    private $stateHashStepMap = [];

    /**
     * @var State[]
     */
    private $queue = [];

    public function solve(): bool
    {
        $found = $this->search();

        if ($found) {
            $reverseMoveLogList = [];

            $hash = $this->endState->getHash();

            while (isset($this->stateHashStepMap[$hash])) {
                $step = $this->stateHashStepMap[$hash];

                $reverseMoveLogList[] = $step->getMoveLog();

                $hash = $step->getFromState()->getHash();
            }

            $this->moveLogList = array_reverse($reverseMoveLogList);
        }

        return $found;
    }

    private function search(): bool
    {
        if (empty($this->queue)) {
            $this->queue[] = $this->beginState;
            $this->addPastState($this->beginState);
        }

        while ($this->queue) {
            $currentState = array_pop($this->queue);
            ++$this->count;

            if ($this->isEndState($currentState)) {
                return true;
            }

            $possibleEndSteps = $this->getPossibleEndSteps($currentState);

            foreach ($possibleEndSteps as $possibleEndStep) {
                $possibleEndState = $possibleEndStep->getNextState();

                $this->stateHashStepMap[$possibleEndState->getHash()] = $possibleEndStep;

                // Операция [] добавления в конец массива
                $this->queue[] = $possibleEndState;
            }
        }

        return false;
    }
}
