<?php

namespace ReenExe\Hanoi;

class Tower
{
    /**
     * числовой массив
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
        // count возвращает длину массив
        return count($this->disks);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        // count возвращает длину массив
        return count($this->disks) === 0;
    }

    /**
     * @return int
     */
    public function getTop(): int
    {
        // end получаю значение последнего элемента массива
        // элемент остается в массиве
        return end($this->disks);
    }

    /**
     * @param int $disk
     */
    public function addTop(int $disk)
    {
        // Операция [] добавления в конец массива
        $this->disks[] = $disk;
    }

    /**
     * @return int
     */
    public function fetchTop(): int
    {
        // array_pop удаляю первый элемент массива и возвращаю как результат функции
        return array_pop($this->disks);
        // $array = [1, 2, 3];
        // $element = array_pop($array);
        // $element стал 1
        // $array стал [2, 3]
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        $hash = '';
        foreach ($this->disks as $disk) {
            // Операция точка это добавление строк
            $hash = $hash . $disk . ',';
        }
        return $hash;
    }

    /**
     * @return Tower
     */
    public function clone()
    {
        return new Tower($this->disks);
    }
}
