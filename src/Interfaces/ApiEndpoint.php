<?php

namespace SyncManager\Interfaces;

use WP_Error;
use WP_REST_Request;

interface ApiEndpoint
{
    public function registerRoute(): void;
    public function callback(WP_REST_Request $request): WP_Error|array;
}
