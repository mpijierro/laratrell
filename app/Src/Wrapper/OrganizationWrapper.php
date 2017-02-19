<?php

namespace LaraTrell\Src\Wrapper;

class OrganizationWrapper
{
    private $organization;

    public function __construct(array $organization)
    {
        $this->organization = $organization;
    }

    public function getId()
    {
        return $this->organization['id'];
    }

    public function getDisplayName()
    {
        return $this->organization['displayName'];
    }
}
