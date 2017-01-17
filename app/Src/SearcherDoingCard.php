<?php

namespace LaraTrell\Src;

class SearcherDoingCard
{

    const NAME_LIST_DOING_IN_TRELLO = 'Doing';

    private $wrapper;
    private $organizations;
    private $workingBoards;

    public function __construct(TrelloWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
        $this->workingBoards = collect();
        $this->organizations = collect();
    }

    public function getWorkingBoards()
    {
        return $this->workingBoards;
    }

    public function getOrganizations()
    {
        return $this->organizations;
    }

    public function searchDoingCard()
    {

        $boards = $this->wrapper->obtainBoardsFromUser();

        foreach ($boards as $itemBoard) {

            $boardWrapper = app(BoardWrapper::class, ['board' => $itemBoard]);

            if ($boardWrapper->boardIsOpen()) {

                if ( ! is_null($boardWrapper->getIdOrganization())) {
                    $this->obtainOrganization($boardWrapper->getIdOrganization());
                }

                $this->processBoard($boardWrapper);
            }
        }

    }

    private function obtainOrganization(string $idOrganization)
    {

        $existsOrganization = isset($this->organizations[$idOrganization]);

        if ( ! $existsOrganization) {

            $organization = $this->wrapper->obtainOrganization($idOrganization);

            $organizationWrapper = app(OrganizationWrapper::class, ['organization' => $organization]);

            $this->organizations->put($organizationWrapper->getId(), $organization);
        }

    }


    private function processBoard(BoardWrapper $board)
    {

        $boardLists = $this->wrapper->obtainListsOfBoard($board->getId());

        $doingList = $this->obtainListDoing($boardLists);

        $boardHasDoingList = ! is_null($doingList);

        if ($boardHasDoingList) {

            $this->createBoardDoing($board, $doingList);

        }

    }

    private function obtainListDoing($listsCard)
    {

        return $listsCard->filter(function ($list) {
            return $list['name'] == self::NAME_LIST_DOING_IN_TRELLO;
        })->first();

    }

    private function createBoardDoing(BoardWrapper $board, $listDoing)
    {

        $doingCards = $this->wrapper->obtainCardsFromCardList($listDoing['id']);

        $boardDoing = app(BoardDoing::class, ['name' => $board->getName(), 'cards' => $doingCards]);

        $this->workingBoards->push($boardDoing);

    }


}