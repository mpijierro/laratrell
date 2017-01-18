<?php


namespace LaraTrell\Src;


use Illuminate\Support\Collection;

class BoardDoing
{

    /**
     * @var OrganizationWrapper
     */
    private $organization;
    /**
     * @var BoardWrapper
     */
    private $board;
    /**
     * @var ListBoardWrapper
     */
    private $list;
    /**
     * @var Collection
     */
    private $cards;

    public function __construct(OrganizationWrapper $organization, BoardWrapper $board, ListBoardWrapper $list, Collection $cards)
    {
        $this->organization = $organization;
        $this->board = $board;
        $this->list = $list;
        $this->cards = $cards;
    }

    public function getBoardName()
    {
        return $this->board->getName();
    }

    public function getOrganizationName()
    {
        return $this->organization->getDisplayName();
    }

    public function getCards()
    {
        return $this->cards;
    }

}