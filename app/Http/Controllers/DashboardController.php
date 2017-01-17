<?php

namespace LaraTrell\Http\Controllers;

use LaraTrell\Http\Requests;
use LaraTrell\Src\Boards;
use LaraTrell\Src\Cards;
use LaraTrell\Src\ListsBoards;
use LaraTrell\Src\Organizations;
use LaraTrell\Src\SearcherDoingCard;
use LaraTrell\Src\TrelloUser;
use LaraTrell\Src\TrelloWrapper;

class DashboardController extends Controller
{

    /**
     * @var TrelloUser;
     */
    private $user;
    /**
     * @var TrelloWrapper
     */
    private $wrapper;


    public function dashboard()
    {

        try {

            $this->initialize();

            $organizations = $this->obtainOrganizations();

            $boards = $this->obtainBoards();

            $lists = $this->obtainLists();

            $cards = $this->obtainCards();

            dd($organizations, $boards, $lists, $cards);

            $this->obtainWorkingBoards();

            return view('dashboard');

        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }

    }

    private function initialize()
    {

        $this->user = app(TrelloUser::class);

        $this->wrapper = app(TrelloWrapper::class, ['user' => $this->user]);
    }

    private function obtainOrganizations(): Organizations
    {

        return app(Organizations::class, ['wrapper' => $this->wrapper]);

        view()->share('organizations', $organizations);

    }

    private function obtainBoards(): Boards
    {

        return app(Boards::class, ['wrapper' => $this->wrapper]);
    }

    private function obtainLists(): ListsBoards
    {

        return app(ListsBoards::class, ['wrapper' => $this->wrapper]);
    }

    private function obtainCards(): Cards
    {

        return app(Cards::class, ['wrapper' => $this->wrapper]);

    }

    private function obtainWorkingBoards()
    {

        $searcher = app(SearcherDoingCard::class, ['wrapper' => $this->wrapper]);
        $searcher->searchDoingCard();

        view()->share('workingBoards', $searcher->getWorkingBoards());
    }

}
