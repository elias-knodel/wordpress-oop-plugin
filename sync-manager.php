<?php

/**
 * Plugin Name: Sync Manager
 * Plugin URI: https://github.com/elias-knodel/wordpress-oop-plugin
 * Description: OOP WordPress Project with modern API
 * Version: 0.3.0
 * Author: Elias Knodel
 * Author URI: https://github.com/elias-knodel
 * License: MIT
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    die;
}

// Define plugin path
if (! defined('SYNC_MANAGER_PLUGIN_FILE')) {
    define('SYNC_MANAGER_PLUGIN_FILE', __FILE__);
}

// Check if the class has already been defined
if (class_exists('SyncManager\SyncManager')) {
    // Throw a WordPress admin error message
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Another Plugin has already defined Sync-Manager. Please contact the Plugin Admin</p></div>';
    });

    return;
}

// Autoload classes
require_once __DIR__ . '/vendor/autoload.php';

// Use your namespace
use SyncManager\Database\Entity\ApiKey;
use SyncManager\Database\EntityManager;
use SyncManager\SyncManager;

// Initialize your plugin
$syncManager = new SyncManager();
$syncManager->init();

// Plugin Hooks
register_activation_hook(__FILE__, 'ek_sync_manager_activate');
function ek_sync_manager_activate()
{
    // Activation code here
    $entityManager = new EntityManager(ApiKey::class);
    $sql = ApiKey::createTableSql();
    $result = $entityManager->createTable($sql);

    if (is_wp_error($result)) {
        // Handle error
        echo $result->get_error_message();
    } else {
        echo "Table created successfully";
    }
}

register_deactivation_hook(__FILE__, 'ek_sync_manager_deactivate');
function ek_sync_manager_deactivate()
{
    // Deactivation code here
}

register_uninstall_hook(__FILE__, 'ek_sync_manager_uninstall');
function ek_sync_manager_uninstall()
{
    $entityManager = new EntityManager('api_keys');
    // Uninstall code here
    $result = $entityManager->dropTable();

    if (is_wp_error($result)) {
        // Handle error
        echo $result->get_error_message();
    } else {
        echo "Table dropped successfully";
    }
}
