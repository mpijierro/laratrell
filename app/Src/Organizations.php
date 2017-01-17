<?php

namespace LaraTrell\Src;


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

    public function getOrganizationByIdOrNull(string $idOrganization): OrganizationWrapper
    {
        return $this->organizations->get($idOrganization);
    }

    public function getOrganizationNameById(string $idOrganization = null): string
    {
        if (is_null($idOrganization)) {
            return '';
        }
        $organization = $this->getOrganizationByIdOrNull($idOrganization);

        return ! is_null($organization) ? $organization->getDisplayName() : '';
    }

}