<?php

namespace LaraTrell\Src;

use Illuminate\Support\Collection;
use LaraTrell\Src\Wrapper\CardWrapper;
use LaraTrell\Src\Wrapper\TrelloWrapper;

class Cards
{

    private $wrapper;
    private $listsBoards;
    private $cards;

    public function __construct(TrelloWrapper $wrapper, Collection $listsBoards)
    {
        $this->wrapper = $wrapper;
        $this->listsBoards = $listsBoards;
        $this->cards = collect();

        $this->obtainCards();

    }

    public function getCards()
    {
        return $this->cards;
    }

    private function obtainCards()
    {

        foreach ($this->listsBoards as $listBoardWrapper) {

            $cards = $this->wrapper->obtainCardsFromCardList($listBoardWrapper->getId());

            foreach ($cards as $card) {

                $cardWrapper = app(CardWrapper::class, ['card' => $card]);

                $this->cards->put($cardWrapper->getId(), $cardWrapper);
            }

        }

    }

    public function getCardByIdOrNull(string $idCard): CardWrapper
    {
        return $this->cards->get($idCard);
    }

    public function getCardNameById(string $idCard = null): string
    {

        $card = $this->getCardByIdOrNull($idCard);

        return ! is_null($card) ? $card->getDisplayName() : '';
    }

    public function getCardByIdList($idList): Collection
    {
        return $this->cards->filter(function ($cardWrapper) use ($idList) {
            return $cardWrapper->getIdList() == $idList;
        });
    }

}