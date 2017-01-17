<?php

namespace LaraTrell\Src;


class BoardWrapper
{

    private $board = [];

    public function __construct(array $board)
    {
        $this->board = $board;
    }

    public function getId()
    {
        return $this->board['id'];
    }

    public function getName()
    {
        return $this->board['name'];
    }

    public function getIdOrganization()
    {
        return $this->board['idOrganization'];
    }

    public function boardIsOpen()
    {
        return ! $this->board['closed'];
    }


}