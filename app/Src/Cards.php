<?php

namespace LaraTrell\Src;


class Cards
{

    private $wrapper;
    private $cards;

    public function __construct(TrelloWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
        $this->cards = collect();

        $this->obtainCards();

    }

    private function obtainCards()
    {

        $cards = $this->wrapper->obtainCards();

        foreach ($cards as $card) {

            $cardWrapper = app(CardWrapper::class, ['card' => $card]);

            $this->cards->put($cardWrapper->getId(), $cardWrapper);

        }

    }

    public function getCardByIdOrNull(string $idCard): CardWrapper
    {
        return $this->cards->get($idCard);
    }

    public function getCardNameById(string $idCard = null): string
    {
        if (is_null($idCard)) {
            return '';
        }
        $card = $this->getCardByIdOrNull($idCard);

        return ! is_null($card) ? $card->getDisplayName() : '';
    }

}