<?php

return [
    'name' => 'OzPos',
    'manifest' => [
        'name' => env('APP_NAME', 'OzPos'),
        'short_name' => 'OzPos',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '16' => [
                'path' => '/images/icons/16.png',
                'purpose' => 'maskable any'
            ],
            '20' => [
                'path' => '/images/icons/20.png',
                'purpose' => 'maskable any'
            ],
            '29' => [
                'path' => '/images/icons/29.png',
                'purpose' => 'maskable any'
            ],
            '32' => [
                'path' => '/images/icons/32.png',
                'purpose' => 'maskable any'
            ],
            '40' => [
                'path' => '/images/icons/40.png',
                'purpose' => 'maskable any'
            ],
            '48' => [
                'path' => '/images/icons/48.png',
                'purpose' => 'maskable any'
            ],
            '50' => [
                'path' => '/images/icons/50.png',
                'purpose' => 'maskable any'
            ],
            '55' => [
                'path' => '/images/icons/55.png',
                'purpose' => 'maskable any'
            ],
            '57' => [
                'path' => '/images/icons/57.png',
                'purpose' => 'maskable any'
            ],
            '58' => [
                'path' => '/images/icons/58.png',
                'purpose' => 'maskable any'
            ],
            '60' => [
                'path' => '/images/icons/60.png',
                'purpose' => 'maskable any'
            ],
            '64' => [
                'path' => '/images/icons/64.png',
                'purpose' => 'maskable any'
            ],
            '72' => [
                'path' => '/images/icons/72.png',
                'purpose' => 'maskable any'
            ],
            '76' => [
                'path' => '/images/icons/76.png',
                'purpose' => 'maskable any'
            ],
            '80' => [
                'path' => '/images/icons/80.png',
                'purpose' => 'maskable any'
            ],
            '87' => [
                'path' => '/images/icons/87.png',
                'purpose' => 'maskable any'
            ],
            '88' => [
                'path' => '/images/icons/88.png',
                'purpose' => 'maskable any'
            ],
            '100' => [
                'path' => '/images/icons/100.png',
                'purpose' => 'maskable any'
            ],
            '114' => [
                'path' => '/images/icons/114.png',
                'purpose' => 'maskable any'
            ],
            '120' => [
                'path' => '/images/icons/120.png',
                'purpose' => 'maskable any'
            ],
            '128' => [
                'path' => '/images/icons/128.png',
                'purpose' => 'maskable any'
            ],
            '144' => [
                'path' => '/images/icons/144.png',
                'purpose' => 'maskable any'
            ],
            '152' => [
                'path' => '/images/icons/152.png',
                'purpose' => 'maskable any'
            ],
            '167' => [
                'path' => '/images/icons/167.png',
                'purpose' => 'maskable any'
            ],
            '172' => [
                'path' => '/images/icons/172.png',
                'purpose' => 'maskable any'
            ],
            '180' => [
                'path' => '/images/icons/180.png',
                'purpose' => 'maskable any'
            ],
            '196' => [
                'path' => '/images/icons/196.png',
                'purpose' => 'maskable any'
            ],
            '216' => [
                'path' => '/images/icons/216.png',
                'purpose' => 'maskable any'
            ],
            '256' => [
                'path' => '/images/icons/256.png',
                'purpose' => 'maskable any'
            ],
            '512' => [
                'path' => '/images/icons/512.png',
                'purpose' => 'maskable any'
            ],
            '1024' => [
                'path' => '/images/icons/1024.png',
                'purpose' => 'maskable any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash-590x1280.png',
//            '640x1136' => '/images/icons/splash-640x1136.png',
//            '750x1334' => '/images/icons/splash-750x1334.png',
//            '828x1792' => '/images/icons/splash-828x1792.png',
//            '1125x2436' => '/images/icons/splash-1125x2436.png',
//            '1242x2208' => '/images/icons/splash-1242x2208.png',
//            '1242x2688' => '/images/icons/splash-1242x2688.png',
//            '1536x2048' => '/images/icons/splash-1536x2048.png',
//            '1668x2224' => '/images/icons/splash-1668x2224.png',
//            '1668x2388' => '/images/icons/splash-1668x2388.png',
//            '2048x2732' => '/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
//                    "src" => "/images/icons/icon-72x72.png",
                    "src" => "/images/icons/72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
