<?php

namespace LaraTrell\Src;

use LaraTrell\Src\Wrapper\OrganizationWrapper;

class BuilderDashboard
{

    private $organizations;
    private $boards;
    private $lists;
    private $cards;

    private $boardsDoing;

    public function __construct(Organizations $organizations, Boards $boards, ListsBoards $lists, Cards $cards)
    {

        $this->organizations = $organizations;
        $this->boards = $boards;
        $this->lists = $lists;
        $this->cards = $cards;

        $this->boardsDoing = collect();

        $this->build();

    }

    public function getBoardsDoing()
    {
        return $this->boardsDoing;
    }


    public function build()
    {

        foreach ($this->lists->obtainListNamedAs('Doing') as $list) {

            $board = $this->obtainBoard($list->getIdBoard());

            $organization = $this->obtainOrganization($board->getIdOrganization());

            $cards = $this->obtainCards($list->getId());

            if ( ! $cards->isEmpty()) {

                $boardDoing = app(BoardDoing::class, [
                    'organization' => $organization,
                    'board' => $board,
                    'list' => $list,
                    'cards' => $cards
                ]);

                $this->boardsDoing->put($board->getName(), $boardDoing);

            }
        }

    }


    private function obtainOrganization($idOrganization)
    {

        if ( ! $idOrganization) {
            return $this->obtainOrganizationWrapperWithoutOrganization();
        }

        $organization = $this->organizations->getOrganizationByIdOrNull($idOrganization);

        if (is_null($organization)) {
            return $this->obtainOrganizationWrapperWithoutOrganization();
        }


        return $organization;
    }

    private function obtainBoard($idBoard)
    {
        return $this->boards->getBoardByIdOrNull($idBoard);
    }

    private function obtainCards($idList)
    {
        return $this->cards->getCardByIdList($idList);
    }

    private function obtainOrganizationWrapperWithoutOrganization()
    {
        return app(OrganizationWrapper::class, ['organization' => ['displayName' => trans('laratrell.without_organization')]]);
    }
}