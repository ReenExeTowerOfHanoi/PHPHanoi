<?php

namespace ReenExe\Hanoi;

class BreadthFirstSearch extends CommonStateSearcher
{
    public function solve(): bool
    {
        $queue = [$this->beginState];
        $this->addPastState($this->beginState);

        while ($queue) {
            $currentState = array_pop($queue);

            if ($this->isEndState($currentState)) {
                return true;
            }

            $possibleEndSteps = $this->getPossibleEndSteps($currentState);

            foreach ($possibleEndSteps as $possibleEndStep) {
                $possibleEndState = $possibleEndStep->getState();

                if ($this->isPastState($possibleEndState)) {
                    continue;
                }

                $this->addPastState($possibleEndState);

                $this->moveLogList[] = $possibleEndStep->getMoveLog();

                // Операция [] добавления в конец массива
                $queue[] = $possibleEndState;
            }
        }

        return false;
    }
}
