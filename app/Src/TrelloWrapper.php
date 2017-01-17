<?php

namespace LaraTrell\Src;

use Illuminate\Support\Collection;
use Trello\Client;

class TrelloWrapper
{

    private $client;
    private $user;

    public function __construct(TrelloUser $user)
    {
        $this->user = $user;
        //dd($this->user);
        $this->instanceClient();

    }

    private function instanceClient()
    {
        $this->client = new Client();
        //$this->client->authenticate($this->user->username(), Client::AUTH_URL_TOKEN);
        $this->client->authenticate(config('laratrell.token'), $this->user->token(), Client::AUTH_URL_CLIENT_ID);
    }

    public function obtainBoardsFromUser(): Collection
    {
        return collect($this->client->api('members')->boards()->all($this->user->username()));
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