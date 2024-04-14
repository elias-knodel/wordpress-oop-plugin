<?php

namespace SyncManager\Admin;

use SyncManager\Admin\Page\BasePage;
use SyncManager\Interfaces\Manager;

class AdminPageManager implements Manager
{
    public BasePage $basePage;

    public function __construct()
    {
        $this->basePage = new BasePage();
    }

    public function init(): void
    {
        add_action('admin_menu', array( $this->basePage, 'menu' ));
    }
}
