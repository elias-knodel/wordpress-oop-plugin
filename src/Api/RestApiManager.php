<?php

namespace SyncManager\Api;

use SyncManager\Api\User\UserApiEndpoint;
use SyncManager\Interfaces\Manager;

class RestApiManager implements Manager
{
    public UserApiEndpoint $userApiEndpoint;

    public function __construct()
    {
        $this->userApiEndpoint = new UserApiEndpoint();
    }

    public function init(): void
    {
        $this->userApiEndpoint->registerRoute();
    }
}
