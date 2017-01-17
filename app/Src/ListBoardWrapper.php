<?php

namespace LaraTrell\Src;


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

    public function getName()
    {
        return $this->list['name'];
    }

    public function isOpen()
    {
        return ! $this->list['closed'];
    }

}