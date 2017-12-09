<?php

namespace ReenExe\Hanoi;

class LevelMoveLog extends MoveLog
{
    /**
     * @var int
     */
    private $level;

    public function __construct($from, $to, int $disk, int $level)
    {
        parent::__construct($from, $to, $disk);
        $this->level = $level;
    }

    public function toString(): string
    {
        return json_encode([
            'from' => $this->from,
            'to' => $this->to,
            'disk' => $this->disk,
            'level' => $this->level,
        ]);
    }
}