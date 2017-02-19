<?php

namespace LaraTrell\Src\Wrapper;

class CardWrapper
{
    private $card = [];

    public function __construct(array $card)
    {
        $this->card = $card;
    }

    public function getId()
    {
        return $this->card['id'];
    }

    public function getIdBoard()
    {
        return $this->card['idBoard'];
    }

    public function getIdList()
    {
        return $this->card['idList'];
    }

    public function getName()
    {
        return $this->card['name'];
    }

    public function getIdOrganization()
    {
        return $this->card['idOrganization'];
    }

    public function cardIsOpen()
    {
        return !$this->card['closed'];
    }

    public function getShortUrl()
    {
        return $this->card['shortUrl'];
    }
}
