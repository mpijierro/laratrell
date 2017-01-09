<?php

namespace LaraTrell\Http\Controllers;

use LaraTrell\Http\Requests;
use LaraTrell\Src\SearcherDoingCard;
use LaraTrell\Src\TrelloWrapper;

class DashboardController extends Controller
{

    private $workingBoards = null;

    public function __construct()
    {
        $this->workingBoards = collect();
    }

    public function dashboard()
    {

        try {

            $wrapper = app(TrelloWrapper::class, ['username' => config('laratrell.username')]);

            $searcher = app(SearcherDoingCard::class, ['wrapper' => $wrapper]);
            $searcher->searchDoingCard();

            view()->share('workingBoards', $searcher->getWorkingBoards());

            return view('dashboard');

        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }

    }

}
