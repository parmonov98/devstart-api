<?php

use MoonShine\Models\MoonshineUser;
use MoonShine\Exceptions\MoonShineNotFoundException;

return [
    'dir' => 'app/MoonShine',
    'namespace' => 'App\MoonShine',

    'title' => env('MOONSHINE_TITLE', 'Dashboard'),
    'logo' => env('MOONSHINE_LOGO'),
    'logo_small' => env('MOONSHINE_LOGO_SMALL'),

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'),
        'middleware' => ['moonshine'],
        'custom_page_slug' => 'custom_page',
        'notFoundHandler' => MoonShineNotFoundException::class,
    ],
    'use_migrations' => true,
    'use_notifications' => true,
    'auth' => [
        'enable' => true,
        'fields' => [
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar',
        ],
        'guard' => 'moonshine',
        'guards' => [
            'moonshine' => [
                'driver' => 'session',
                'provider' => 'moonshine',
            ],
        ],
        'providers' => [
            'moonshine' => [
                'driver' => 'eloquent',
                'model' => MoonshineUser::class,
            ],
        ],
        'footer' => '',
    ],
    'locales' => [
        'en',
        'ru',
    ],
    'middlewares' => [],
    'tinymce' => [
        'file_manager' => false, // or 'laravel-filemanager' prefix for lfm
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6'),
    ],
    'socialite' => [
        // 'driver' => 'path_to_image_for_button'
    ],
    'header' => null, // blade path
    'footer' => [
        'copyright' => 'Made with ❤️ by <b>PHP community telegram group</b>',
        'nav' => [
            'https://github.com/moonshine-software/moonshine/blob/1.5.x/LICENSE.md' => 'License',
            'https://moonshine.cutcode.dev' => 'Documentation',
            'https://github.com/moonshine-software/moonshine' => 'GitHub',
        ],
    ],
];
