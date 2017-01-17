<?php

namespace LaraTrell\Http\Controllers;

use LaraTrell\Http\Requests;
use LaraTrell\Src\SearcherDoingCard;
use LaraTrell\Src\TrelloUser;
use LaraTrell\Src\TrelloWrapper;

class DashboardController extends Controller
{

    /**
     * @var TrelloUser;
     */
    private $user;

    public function dashboard()
    {

        try {

            $this->user = app(TrelloUser::class);

            $wrapper = app(TrelloWrapper::class, ['user' => $this->user]);

            $searcher = app(SearcherDoingCard::class, ['wrapper' => $wrapper]);
            $searcher->searchDoingCard();

            view()->share('workingBoards', $searcher->getWorkingBoards());

            return view('dashboard');

        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }

    }

}
