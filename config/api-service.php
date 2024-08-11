<?php

return [
    // 'navigation' => [
    //     'token' => false, 
    //     // 'token' => [
    //     //     'group' => 'User',
    //     //     'sort' => -1,
    //     //     'icon' => 'heroicon-o-key',
    //     // ],
    // ],
    'navigation' => false,
    'models' => [
        'token' => [
            'enable_policy' => true,
        ],
    ],
    'route' => [
        'panel_prefix' => true,
        'use_resource_middlewares' => false,
    ],
    'tenancy' => [
        'enabled' => false,
        'awareness' => false,
    ],
];
