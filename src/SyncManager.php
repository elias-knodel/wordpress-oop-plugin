<?php

namespace SyncManager;

use SyncManager\Api\RestApiManager;

class SyncManager
{
    private RestApiManager $restApiManager;

    /**
     * Construction code here
     */
    public function __construct()
    {
        $this->restApiManager = new RestApiManager();
    }

    /**
     * Initialization code here
     */
    public function init(): void
    {
        // Hook into WordPress actions and filters here
        add_action('rest_api_init', array( $this->restApiManager, 'registerApiRoutes' ));
    }
}
