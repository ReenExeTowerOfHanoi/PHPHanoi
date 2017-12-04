<?php

namespace ReenExe\Hanoi;

class Tower implements \JsonSerializable
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
        return end($this->disks);
    }

    /**
     * @param int $disk
     */
    public function addTop(int $disk)
    {
        $this->disks[] = $disk;
    }

    /**
     * @return int
     */
    public function fetchTop(): int
    {
        return array_pop($this->disks);
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return json_encode($this->disks);
    }

    /**
     * @return Tower
     */
    public function clone()
    {
        return new self($this->disks);
    }
}
