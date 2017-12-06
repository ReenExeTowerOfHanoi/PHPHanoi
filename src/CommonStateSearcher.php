<?php

namespace ReenExe\Hanoi;

class CommonStateSearcher
{
    /**
     * @var State
     */
    protected $beginState;

    /**
     * @var State
     */
    protected $endState;

    /**
     * Массив строк
     * Это свойство для сохранения уже пройденных состояний
     * Чтобы состояния можна было сравнить они конвертируются в строки
     * Пример:
     *          "{"B":"[7,6,5,4,3,2]","X":"[1]","Y":"[]","E":"[]"}"
     * В других языкам можно использовать другие форматы для отображения состояния ввиде строки
     * Например очень просто написать что-то такое:
     *          "B:7,6,5,4,3,2,;"X":1,;Y:;E:;"
     * @var array
     */
    protected $pastStateMap = [];

    /**
     * DeepFirstSearch constructor.
     * @param State $beginState
     * @param State $endState
     */
    public function __construct(State $beginState, State $endState)
    {
        $this->beginState = $beginState;
        $this->endState = $endState;
    }

    protected function isPastState(State $state)
    {
        // Проверяю по наличию ключа
        return isset($this->pastStateMap[$state->getHash()]);
    }

    protected function addPastState(State $state)
    {
        // Сохраняю чтобы использовать быстрый поиск по ключам
        $this->pastStateMap[$state->getHash()] = true;
    }
}