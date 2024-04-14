<?php

namespace SyncManager\Interfaces;

interface Entity
{
    public const TABLE_NAME = '';

    public static function createTableSql(): string;
}
