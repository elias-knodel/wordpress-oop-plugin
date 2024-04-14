<?php

namespace SyncManager\Api\User;

use SyncManager\Interfaces\ApiEndpoint;
use WP_Error;
use WP_REST_Request;

class UserApiEndpoint implements ApiEndpoint
{
    public function registerRoute(): void
    {
        register_rest_route('ek-sync-manager/v1', '/user/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'callback' ),
            'args'     => array(
                'id' => array(
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param);
                    }
                ),
            ),
        ));
    }

    public function callback(WP_REST_Request $request): WP_Error|array
    {
        $userId = $request->get_param('id');
        $user   = get_userdata($userId);

        if (! $user) {
            error_log('User not found: ' . $userId);

            return new WP_Error('no_user', 'Invalid user ID', array( 'status' => 404 ));
        }

        return array(
            'id'    => $user->ID,
            'name'  => $user->display_name,
            'user_nicename'  => $user->user_nicename,
            'email' => $user->user_email,
        );
    }
}
