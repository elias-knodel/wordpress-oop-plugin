<?php

namespace SyncManager\Api\User;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use SyncManager\Interfaces\ApiEndpoint;

class UserApiEndpoint implements ApiEndpoint
{
    private Serializer $serializer;

    public function __construct()
    {
        $encoders    = [ new JsonEncoder() ];
        $normalizers = [ new ObjectNormalizer() ];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function registerRoutes(): void
    {
        register_rest_route('sync-manager/v1', '/user/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'getUser' ),
            'args'     => array(
                'id' => array(
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param);
                    }
                ),
            ),
        ));
    }

    public function getUser(\WP_REST_Request $request): \WP_Error|array
    {
        $userId = $request->get_param('id');
        $user   = get_userdata($userId);

        if (! $user) {
            return new \WP_Error('no_user', 'Invalid user ID', array( 'status' => 404 ));
        }

        // Deserialize the received data into a User object
        $receivedUser = $this->serializer->deserialize($user, WP_User::class, 'json');

        // Prepare the data for wp_insert_user
        $userData = array(
            'user_login' => $receivedUser->getUsername(),
            'user_email' => $receivedUser->getEmail(),
            'user_pass'  => null,  // When creating a user, `user_pass` is expected.
        );

        // Insert the user into the database
        $userId = wp_insert_user($userData);

        // Check for errors
        if (is_wp_error($userId)) {
            return new \WP_Error('cannot_create_user', 'Failed to create new user', array( 'status' => 500 ));
        }

        return array(
            'id'       => $userId,
            'username' => $receivedUser->getUsername(),
            'email'    => $receivedUser->getEmail(),
        );
    }
}
