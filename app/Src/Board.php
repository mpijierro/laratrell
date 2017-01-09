<?php


namespace LaraTrell\Src;


use Illuminate\Support\Collection;

class Board
{

    private $name;

    private $cards;

    public function getName()
    {
        return $name;
    }

    public function getCards()
    {
        return $this->cards;
    }

    public function __construct($name, Collection $cards)
    {
        $this->name = $name;
        $this->cards = $cards;
    }

}