<?php

namespace LaraTrell\Src\Wrapper;

use Illuminate\Support\Collection;
use Trello\Client;

class TrelloWrapper
{
    private $client;
    private $user;

    public function __construct(UserInterfaceWrapper $user)
    {
        $this->user = $user;

        $this->instanceClient();
    }

    private function instanceClient()
    {
        $this->client = new Client();
        $this->client->authenticate(env('TRELLO_KEY'), $this->user->token(), Client::AUTH_URL_CLIENT_ID);
    }

    public function obtainBoards(): Collection
    {
        return collect($this->client->api('members')->boards()->all($this->user->username()));
    }

    public function obtainBoard(string $boardId): array
    {
        return $this->client->api('board')->show($boardId);
    }

    public function obtainLists(): Collection
    {
        return collect($this->client->api('members')->lists()->all($this->user->username()));
    }

    public function obtainListsOfBoard(string $boardId): Collection
    {
        return collect($this->client->api('board')->lists()->all($boardId));
    }

    public function obtainCards(): Collection
    {
        return collect($this->client->api('members')->cards()->all($this->user->username()));
    }

    public function obtainCardsFromCardList(string $listId): Collection
    {
        return collect($this->client->api('list')->cards()->filter($listId));
    }

    public function obtainOrganizations(): Collection
    {
        return collect($this->client->api('members')->organizations()->all($this->user->username()));
    }

    public function obtainOrganization(string $organizationId): array
    {
        return $this->client->api('organization')->show($organizationId);
    }
}
