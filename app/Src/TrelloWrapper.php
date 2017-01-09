<?php

namespace LaraTrell\Src;

use Illuminate\Support\Collection;
use Trello\Client;

class TrelloWrapper
{

    private $client;
    private $username;

    public function __construct($username)
    {

        $this->instanceClient();

        $this->username = $username;

    }

    private function instanceClient()
    {

        $this->client = new Client();
        $this->client->authenticate(config('laratrell.token'), config('laratrell.password'), Client::AUTH_URL_CLIENT_ID);
    }

    public function obtainBoardsFromUser(): Collection
    {
        return collect($this->client->api('members')->boards()->all($this->username));
    }

    public function obtainBoard(string $boardId): array
    {
        return $this->client->api('board')->show($boardId);
    }

    public function obtainListsOfBoard(string $boardId): Collection
    {
        return collect($this->client->api('board')->lists()->all($boardId));
    }


    public function obtainCardsFromCardList(string $listId): Collection
    {
        return collect($this->client->api('list')->cards()->filter($listId));
    }


}