<?php

namespace LaraTrell\Src;

use Illuminate\Support\Collection;
use LaraTrell\Src\Wrapper\BoardWrapper;
use LaraTrell\Src\Wrapper\ListBoardWrapper;
use LaraTrell\Src\Wrapper\TrelloWrapper;

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
}
