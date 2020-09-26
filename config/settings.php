<?php

use Carbon\Carbon;

return [

    /*
     * Wersja projektu
     */

    'app_project_version' => env('APP_PROJECT_VERSION'),

    /*
     * Adres aplikacji
     */

    'app_url' => env('APP_URL'),

    /*
     * Caching time expiration
     */

    'cache_seconds' => Carbon::now()->addDay()->diffInSeconds(),

];
