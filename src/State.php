<?php

namespace ReenExe\Hanoi;

class State
{
    /**
     * @var Tower[]
     */
    private $towers;

    /**
     * @var string
     */
    private $hash = null;

    /**
     * State constructor.
     * @param Tower[] $towers
     */
    public function __construct(array $towers)
    {
        $this->towers = $towers;
    }

    public function getHash(): string
    {
        return $this->hash === null
            ? $this->hash = json_encode($this->towers)
            : $this->hash;
    }

    /**
     * @return array
     */
    public function getTowerNames()
    {
        return array_keys($this->towers);
    }

    /**
     * @param $fromTowerIndex
     * @param $toTowerIndex
     * @return bool
     */
    public function canMoveBetween($fromTowerIndex, $toTowerIndex): bool
    {
        $fromTower = $this->towers[$fromTowerIndex];

        if ($fromTower->isEmpty()) {
            return false;
        }

        $toTower = $this->towers[$toTowerIndex];

        return $toTower->isEmpty() || $fromTower->getTop() < $toTower->getTop();
    }

    /**
     * @param $fromTowerIndex
     * @param $toTowerIndex
     * @return int
     */
    public function move($fromTowerIndex, $toTowerIndex)
    {
        $fromTower = $this->towers[$fromTowerIndex];
        $toTower = $this->towers[$toTowerIndex];
        $disk = $fromTower->fetchTop();
        $toTower->addTop($disk);
        return $disk;
    }

    /**
     * @return State
     */
    public function clone()
    {
        $cloneTowers = [];

        foreach ($this->towers as $key => $tower) {
            $cloneTowers[$key] = $tower->clone();
        }

        return new self($cloneTowers);
    }
}
