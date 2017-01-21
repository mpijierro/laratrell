<?php

namespace LaraTrell\Http\Controllers;

use Illuminate\Support\Collection;
use LaraTrell\Http\Requests;
use LaraTrell\Src\Boards;
use LaraTrell\Src\BuilderDashboard;
use LaraTrell\Src\Cards;
use LaraTrell\Src\ConfigureUser;
use LaraTrell\Src\ListsBoards;
use LaraTrell\Src\Organizations;
use LaraTrell\Src\Wrapper\TrelloWrapper;
use LaraTrell\Src\Wrapper\UserWrapper;
use League\OAuth1\Client\Credentials\CredentialsException;


class DashboardController extends Controller
{

    /**
     * @var UserWrapper;
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

            $lists = $this->obtainLists($boards);

            $cards = $this->obtainCards($lists->obtainListNamedAs('Doing'));


            $builder = app(BuilderDashboard::class, [
                'organizations' => $organizations,
                'boards' => $boards,
                'lists' => $lists,
                'cards' => $cards
            ]);
            $builder->build();

            view()->share('builder', $builder);

            return view('dashboard');

        } catch (\InvalidArgumentException $e) {
            return redirect()->route('home')->withErrors(['errors' => trans('laratrell.token_missing')]);
        } catch (CredentialsException $e) {
            return redirect()->route('home')->withErrors(['errors' => trans('laratrell.token_missing')]);
        } catch (\Exception $e) {
            dd($e);
            abort(500, $e->getMessage());
        }

    }

    private function initialize()
    {

        $this->user = app(UserWrapper::class);

        $configureUser = app(ConfigureUser::class, ['userWrapper' => $this->user]);
        $configureUser->configure();

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

    private function obtainLists(Boards $boards): ListsBoards
    {

        return app(ListsBoards::class, ['wrapper' => $this->wrapper, 'boards' => $boards]);
    }

    private function obtainCards(Collection $lists): Cards
    {

        return app(Cards::class, ['wrapper' => $this->wrapper, 'listsBoards' => $lists]);

    }

}
