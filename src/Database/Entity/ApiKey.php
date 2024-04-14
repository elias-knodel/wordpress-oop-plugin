<?php

namespace SyncManager\Database\Entity;

use SyncManager\Interfaces\Entity;

class ApiKey implements Entity
{
    public const TABLE_NAME = 'api_keys';

    private int $id;
    private string $api_key;
    private int $user_id;

    public function __construct(int $id, string $api_key, int $user_id)
    {
        $this->id      = $id;
        $this->api_key = $api_key;
        $this->user_id = $user_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public static function createTableSql(): string
    {
        global $wpdb;

        return sprintf(
            "CREATE TABLE %s (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            api_key varchar(255) NOT NULL,
            user_id mediumint(9) NOT NULL,
            PRIMARY KEY  (id)
        )",
            $wpdb->prefix . self::TABLE_NAME
        );
    }
}
