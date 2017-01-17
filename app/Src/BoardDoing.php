<?php


namespace LaraTrell\Src;


use Illuminate\Support\Collection;

class BoardDoing
{

    /**
     * @var BoardWrapper
     */
    private $boardWrapper;
    private $cardsDoing;

    public function __construct(BoardWrapper $boardWrapper, Collection $cards)
    {
        $this->boardWrapper = $boardWrapper;
        $this->cardsDoing = $cards;
    }

    public function getIdOrganization()
    {
        return $this->boardWrapper->getIdOrganization();
    }

    public function getName()
    {
        return $this->boardWrapper->getName();
    }

    public function getCardsDoing()
    {
        return $this->cardsDoing;
    }

}