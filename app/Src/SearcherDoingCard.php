<?php

namespace LaraTrell\Src;

class SearcherDoingCard
{

    const NAME_LIST_DOING_IN_TRELLO = 'Doing';

    private $wrapper;

    private $workingBoards;

    public function __construct(TrelloWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
        $this->workingBoards = collect();
    }

    public function getWorkingBoards()
    {
        return $this->workingBoards;
    }

    public function searchDoingCard()
    {

        $boards = $this->wrapper->obtainBoardsFromUser();

        foreach ($boards as $itemBoard) {

            try {
                $boardWrapper = app(BoardWrapper::class, ['board' => $itemBoard]);

                if ($boardWrapper->boardIsOpen()) {
                    $this->processBoard($boardWrapper);
                }
            } catch (\Exception $e) {
                dd($e, $itemBoard);
            }


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

        $boardDoing = app(BoardDoing::class, ['boardWrapper' => $board, 'cards' => $doingCards]);

        $this->workingBoards->push($boardDoing);

    }


}