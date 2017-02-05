<?php

namespace LaraTrell\Http\Controllers;

use Illuminate\Support\Collection;
use LaraTrell\Http\Requests;
use LaraTrell\Src\Boards;
use LaraTrell\Src\BuilderDashboard;
use LaraTrell\Src\Cards;
use LaraTrell\Src\ListsBoards;
use LaraTrell\Src\Organizations;
use LaraTrell\Src\Wrapper\TrelloWrapper;
use LaraTrell\Src\Wrapper\UserSessionWrapper;
use League\OAuth1\Client\Credentials\CredentialsException;


class DashboardController extends Controller
{

    /**
     * @var TrelloWrapper
     */
    private $trelloWrapper;


    public function dashboard()
    {

        try {

            $this->initialize();

            $this->configDashboardView();

            return view('dashboard');

        } catch (\InvalidArgumentException $e) {
            return redirect()->route('home')->withErrors(['errors' => trans('laratrell.token_missing')]);
        } catch (CredentialsException $e) {
            return redirect()->route('home')->withErrors(['errors' => trans('laratrell.token_missing')]);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }

    }

    private function initialize()
    {

        $user = app(UserSessionWrapper::class);

        $this->trelloWrapper = app(TrelloWrapper::class, ['user' => $user]);

    }

    private function configDashboardView()
    {

        $organizations = $this->obtainOrganizations();

        $boards = $this->obtainBoards();

        $lists = $this->obtainLists($boards);

        $cards = $this->obtainCards($lists->obtainListNamedAs('Doing'));

        $builder = app(BuilderDashboard::class, ['organizations' => $organizations, 'boards' => $boards, 'lists' => $lists, 'cards' => $cards]);

        view()->share('builder', $builder);

    }


    private function obtainOrganizations(): Organizations
    {

        return app(Organizations::class, ['wrapper' => $this->trelloWrapper]);

        view()->share('organizations', $organizations);

    }

    private function obtainBoards(): Boards
    {

        return app(Boards::class, ['wrapper' => $this->trelloWrapper]);
    }

    private function obtainLists(Boards $boards): ListsBoards
    {

        return app(ListsBoards::class, ['wrapper' => $this->trelloWrapper, 'boards' => $boards]);
    }

    private function obtainCards(Collection $lists): Cards
    {

        return app(Cards::class, ['wrapper' => $this->trelloWrapper, 'listsBoards' => $lists]);

    }

}
