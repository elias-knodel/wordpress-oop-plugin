<?php

namespace SyncManager\Interfaces;

interface AdminPage
{
    public function menu(): void;
    public function content(): void;
}
