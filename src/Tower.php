<?php

namespace ReenExe\Hanoi;

class Tower
{
    /**
     * @var array
     */
    private $disks;

    /**
     * Tower constructor.
     * @param array $disks
     */
    public function __construct(array $disks)
    {
        $this->disks = $disks;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return count($this->disks);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->disks);
    }

    /**
     * @return int
     */
    public function getTop(): int
    {
        return $this->disks[0];
    }
}
