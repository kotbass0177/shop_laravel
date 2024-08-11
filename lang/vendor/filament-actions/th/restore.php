<?php

return [

    'single' => [

        'label' => 'กู้คืน', // Using "กู้คืน" (goo kคืน) for "restore"

        'modal' => [

            'heading' => 'กู้คืน :label',

            'actions' => [

                'restore' => [
                    'label' => 'กู้คืน',
                ],

            ],

        ],

        'notifications' => [

            'restored' => [
                'title' => 'กู้คืนสำเร็จ', // Using "กู้คืนสำเร็จ" (goo kคืน sam ret) for "restored"
            ],

        ],

    ],

    'multiple' => [

        'label' => 'กู้คืนที่เลือก',

        'modal' => [

            'heading' => 'กู้คืนที่เลือก :label',

            'actions' => [

                'restore' => [
                    'label' => 'กู้คืน',
                ],

            ],

        ],

        'notifications' => [

            'restored' => [
                'title' => 'กู้คืนสำเร็จ',
            ],

        ],

    ],

];
