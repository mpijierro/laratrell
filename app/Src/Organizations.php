<?php

namespace LaraTrell\Src;

use LaraTrell\Src\Wrapper\OrganizationWrapper;
use LaraTrell\Src\Wrapper\TrelloWrapper;

class Organizations
{
    private $wrapper;
    private $organizations;

    public function __construct(TrelloWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
        $this->organizations = collect();

        $this->obtainOrganizations();
    }

    private function obtainOrganizations()
    {
        $organizations = $this->wrapper->obtainOrganizations();

        foreach ($organizations as $organization) {
            $organizationWrapper = app(OrganizationWrapper::class, ['organization' => $organization]);

            $this->organizations->put($organizationWrapper->getId(), $organizationWrapper);
        }
    }

    public function getOrganizationByIdOrNull(string $idOrganization)//: ?OrganizationWrapper
    {
        return $this->organizations->get($idOrganization);
    }
}
