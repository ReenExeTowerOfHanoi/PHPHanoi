<?php

namespace ReenExe\Hanoi;

class Step
{
    /**
     * @var State
     */
    private $state;

    /**
     * @var MoveLog
     */
    private $moveLog;

    /**
     * Step constructor.
     * @param State $state
     * @param MoveLog $moveLog
     */
    public function __construct(State $state, MoveLog $moveLog)
    {
        $this->state = $state;
        $this->moveLog = $moveLog;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @return MoveLog
     */
    public function getMoveLog(): MoveLog
    {
        return $this->moveLog;
    }
}
