<?php

use App\Models\Role;

return [
    // This package supports only class based features.

    /*
    * This is the default state for all class based features and
     * state will be used if there is no segmentation.
    */
    'default' => true,

    /*
     * Default scope: User::class, Team::class
     */
    'scope' => App\Models\User::class,

    /*
     * Column names and data source that can be used to activate or deactivate for a segment of users.
     * This columns must exist on the users table and the data source must be a model.
     * COLUMN: The column name as defined on the default scope model config.
     * MODEL: The eloquent model of the source table.
     * VALUE: The column to be used as value.
     * KEY: The column to be used as key.
     */
    'segments' => [
        [
            'column' => 'name',
            'label' => 'ชื่อ-สกุล',
            'source' => [
                'model' => App\Models\User::class,
                'value' => 'name',
                'key' => 'name',
            ],
        ],
        [
            'column' => 'email',
            'label' => 'อีเมลล์',
            'source' => [
                'model' => App\Models\User::class,
                'value' => 'email',
                'key' => 'email',
            ],
        ],
        [
            'column' => 'roleNames',
            'label' => 'หน้าที่ในระบบ',
            'source' => [
                'model' => Role::class,
                'value' => 'name',
                'key' => 'name',
            ],
        ],
        //        [
        //            'column' => 'currency',
        //            'source' => [
        //                'model' => Squire\Models\Currency::class, // composer require squirephp/currencies-en
        //                'value' => 'code_alphabetic',
        //                'key' => 'code_alphabetic',
        //            ],
        //        ],
    ],

    'panel' => [
        /*
         * Navigation group for admin panel resource.
         */
        'group' => 'จัดการสิทธิ์ผู้ใช้งาน',

        /*
         * Navigation item label for admin panel resource.
         */
        'label' => 'Feature และเงื่อนไขผู้ใช้งาน',

        /*
         * Resource title for admin panel resource.
         */
        'title' => 'Manage Features & Segments',

        /*
         * Navigation item icon for admin panel resource.
         */
        'icon' => 'heroicon-o-cursor-arrow-ripple',
    ],

    'resources' => [
        Stephenjude\FilamentFeatureFlag\Resources\FeatureSegmentResource::class,
    ],
];
