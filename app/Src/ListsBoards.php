<?php

namespace LaraTrell\Src;


use Illuminate\Support\Collection;

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

    public function getBoardsLists()
    {
        return $this->boardsList;
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


    public function obtainListNamedAs(string $name): Collection
    {

        return $this->boardsList->filter(function ($list) use ($name) {
            return $list->getName() == $name;
        });

    }

    /*
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
    */

}