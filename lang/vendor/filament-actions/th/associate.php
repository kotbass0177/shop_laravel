<?php

return [

    'single' => [

        'label' => 'เชื่อมโยง',

        'modal' => [

            'heading' => 'เชื่อมโยง :label',

            'fields' => [

                'record_id' => [
                    'label' => 'รายการ',
                ],

            ],

            'actions' => [

                'associate' => [
                    'label' => 'เชื่อมโยง',
                ],

                'associate_another' => [
                    'label' => 'เชื่อมโยง และเชื่อมโยงอีก',
                ],

            ],

        ],

        'notifications' => [

            'associated' => [
                'title' => 'เชื่อมโยงสำเร็จ',
            ],

        ],

    ],

];
