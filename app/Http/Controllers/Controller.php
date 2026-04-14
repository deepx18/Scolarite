<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

abstract class Controller
{
    protected function reclamationsEnabled(): bool
    {
        return Cache::store(config('cache.default'))->get('reclamations_enabled', true) ?? true;
    }

    protected function setReclamationsEnabled(bool $enabled): void
    {
        Cache::store(config('cache.default'))->forever('reclamations_enabled', $enabled);
    }
}
