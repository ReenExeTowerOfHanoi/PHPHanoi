<?php

namespace ReenExe\Hanoi;

class HeuristicFirstSearch extends CommonStateSearcher
{
    /**
     * @var CommonStateSearcher
     */
    private $stateSearcher;

    /**
     * @var State[]
     */
    private $intermediateStates;

    /**
     * HeuristicFirstSearch constructor.
     * @param State $beginState
     * @param State $endState
     * @param string $stateSearcherClass
     * @param array $intermediateStates
     */
    public function __construct(State $beginState, State $endState, string $stateSearcherClass, array $intermediateStates)
    {
        parent::__construct($beginState, $endState);
        $this->stateSearcher = new $stateSearcherClass($beginState, $endState);
        $this->intermediateStates = $intermediateStates;
    }

    public function solve(): bool
    {
        foreach ($this->getStates() as $endState) {
            $this->stateSearcher->endState = $endState;

            $solved = $this->stateSearcher->solve();

            if ($solved === false) {
                return false;
            }
        }

        return true;
    }

    public function getMoveLogList(): array
    {
        return $this->stateSearcher->getMoveLogList();
    }

    public function getCount(): int
    {
        return $this->stateSearcher->getCount();
    }

    protected function getStates()
    {
        yield from $this->intermediateStates;

        yield $this->endState;
    }
}
