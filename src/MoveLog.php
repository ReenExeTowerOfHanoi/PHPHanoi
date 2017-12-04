<?php

namespace ReenExe\Hanoi;

class MoveLog
{
    /**
     * @var int
     */
    private $from;

    /**
     * @var int
     */
    private $to;

    /**
     * @var int
     */
    private $disk;

    /**
     * MoveLog constructor.
     * @param int $from
     * @param int $to
     * @param int $disk
     */
    public function __construct($from, $to, $disk)
    {
        $this->from = $from;
        $this->to = $to;
        $this->disk = $disk;
    }

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @return int
     */
    public function getTo(): int
    {
        return $this->to;
    }

    /**
     * @return int
     */
    public function getDisk(): int
    {
        return $this->disk;
    }

    public function toString()
    {
        return json_encode([
            'from' => $this->from,
            'to' => $this->to,
            'disk' => $this->disk,
        ]);
    }
}
