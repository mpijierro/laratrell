<?php

namespace LaraTrell\Src\Wrapper;

class ListBoardWrapper
{

    private $list = [];

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function getId()
    {
        return $this->list['id'];
    }

    public function getIdBoard()
    {
        return $this->list['idBoard'];
    }

    public function getName()
    {
        return $this->list['name'];
    }

    public function isOpen()
    {
        return ! $this->list['closed'];
    }

    public function isNamed($name)
    {
        return ($this->list['name'] == $name);
    }

}