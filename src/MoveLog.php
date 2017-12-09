<?php

namespace ReenExe\Hanoi;

class MoveLog
{
    /**
     * @var int|string
     */
    private $from;

    /**
     * @var int|string
     */
    private $to;

    /**
     * @var int
     */
    private $disk;

    /**
     * MoveLog constructor.
     * @param int|string $from
     * @param int|string $to
     * @param int $disk
     */
    public function __construct($from, $to, $disk)
    {
        $this->from = $from;
        $this->to = $to;
        $this->disk = $disk;
    }

    public function toString(): string
    {
        return json_encode([
            'from' => $this->from,
            'to' => $this->to,
            'disk' => $this->disk,
        ]);
    }

    /**
     * @return int|string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return int|string
     */
    public function getTo()
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
}
