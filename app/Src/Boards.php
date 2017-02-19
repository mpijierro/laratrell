<?php

namespace LaraTrell\Src;

use LaraTrell\Src\Wrapper\BoardWrapper;
use LaraTrell\Src\Wrapper\TrelloWrapper;

class Boards
{
    private $wrapper;
    private $boards;

    public function __construct(TrelloWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
        $this->boards = collect();

        $this->obtainBoards();
    }

    public function getBoards()
    {
        return $this->boards;
    }

    private function obtainBoards()
    {
        $boards = $this->wrapper->obtainBoards();

        foreach ($boards as $board) {
            $boardWrapper = app(BoardWrapper::class, ['board' => $board]);

            if ($boardWrapper->isOpen()) {
                $this->boards->put($boardWrapper->getId(), $boardWrapper);
            }
        }
    }

    public function getBoardByIdOrNull(string $idBoard): BoardWrapper
    {
        return $this->boards->get($idBoard);
    }

    public function getBoardNameById(string $idBoard = null): string
    {
        if (is_null($idBoard)) {
            return '';
        }
        $board = $this->getBoardByIdOrNull($idBoard);

        return !is_null($board) ? $board->getDisplayName() : '';
    }
}
