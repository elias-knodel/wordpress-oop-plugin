<?php

namespace SyncManager\Api;

use SyncManager\Api\User\UserApiEndpoint;

class RestApiManager
{
    public function registerApiRoutes(): void
    {
        $userApiEndpoint = new UserApiEndpoint();
        $userApiEndpoint->registerRoutes();
    }
}
