<?php

namespace ReenExe\Hanoi;

class Step
{
    /**
     * @var State
     */
    private $fromState;
    /**
     * @var State
     */
    private $nextState;

    /**
     * @var MoveLog
     */
    private $moveLog;

    /**
     * Step constructor.
     * @param State $fromState
     * @param State $nextState
     * @param MoveLog $moveLog
     */
    public function __construct(State $fromState, State $nextState, MoveLog $moveLog)
    {
        $this->fromState = $fromState;
        $this->nextState = $nextState;
        $this->moveLog = $moveLog;
    }

    /**
     * @return State
     */
    public function getFromState(): State
    {
        return $this->fromState;
    }

    /**
     * @return State
     */
    public function getNextState(): State
    {
        return $this->nextState;
    }

    /**
     * @return MoveLog
     */
    public function getMoveLog(): MoveLog
    {
        return $this->moveLog;
    }
}
