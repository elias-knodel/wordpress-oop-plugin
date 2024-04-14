<?php

namespace SyncManager\Admin\Page;

use SyncManager\Interfaces\AdminPage;

class BasePage implements AdminPage
{
    public function menu(): void
    {
        add_menu_page(
            'Sync Manager', // Page title
            'Sync Manager', // Menu title
            'administrator', // Capability
            'ek-sync-manager', // Menu slug
            array( $this, 'content' ), // Function to display the page content
            'dashicons-admin-generic', // Icon URL
            80 // Position
        );
    }

    public function content(): void
    {
        echo '<h1>Welcome to Sync Manager</h1>';
    }
}
