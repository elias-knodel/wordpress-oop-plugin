<?php

namespace SyncManager;

use SyncManager\Admin\AdminPageManager;
use SyncManager\Api\RestApiManager;
use SyncManager\Interfaces\Manager;

class SyncManager implements Manager
{
    private RestApiManager $restApiManager;

    private AdminPageManager $adminPageManager;

    /**
     * Construction code here
     */
    public function __construct()
    {
        $this->restApiManager = new RestApiManager();
        $this->adminPageManager = new AdminPageManager();
    }

    /**
     * Initialization code here
     */
    public function init(): void
    {
        // Hook into WordPress actions and filters here
        add_action('rest_api_init', array( $this->restApiManager, 'init' ));
        add_action('init', array( $this->adminPageManager, 'init' ));
    }
}
