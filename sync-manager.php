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

// Plugin Hooks
register_activation_hook(__FILE__, 'my_plugin_activate');
function my_plugin_activate()
{
    // Activation code here
}

register_deactivation_hook(__FILE__, 'my_plugin_deactivate');
function my_plugin_deactivate()
{
    // Deactivation code here
}

register_uninstall_hook(__FILE__, 'my_plugin_uninstall');
function my_plugin_uninstall()
{
    // Uninstall code here
}

// Autoload classes
require_once __DIR__ . '/vendor/autoload.php';

// Use your namespace
use SyncManager\SyncManager;

// Initialize your plugin
$syncManager = new SyncManager();
$syncManager->init();
