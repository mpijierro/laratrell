<?php

namespace LaraTrell\Src;


class ListsBoards
{

    private $wrapper;
    private $boardsList;
    private $boards;

    public function __construct(TrelloWrapper $wrapper, Boards $boards)
    {
        $this->wrapper = $wrapper;
        $this->boardsList = collect();
        $this->boards = $boards;

        $this->obtainListsBoards();

    }

    private function obtainListsBoards()
    {

        foreach ($this->boards->getBoards() as $board) {

            $this->processBoard($board);

        }

    }


    private function processBoard(BoardWrapper $board)
    {

        $boardLists = $this->wrapper->obtainListsOfBoard($board->getId());

        foreach ($boardLists as $list) {

            $this->putListsInBoardList($list);

        }

    }

    private function putListsInBoardList(array $list)
    {
        $listBoardWrapper = app(ListBoardWrapper::class, ['list' => $list]);

        $this->boardsList->put($listBoardWrapper->getId(), $listBoardWrapper);
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


    public function getListBoardByIdOrNull(string $idListBoard): ListBoardWrapper
    {
        return $this->boardsList->get($idListBoard);
    }

    public function getListListBoardNameById(string $idListBoard = null): string
    {
        $iistBoard = $this->getListBoardByIdOrNull($idListBoard);

        return ! is_null($idListBoard) ? $listBoard->getName() : '';
    }

}