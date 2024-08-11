<?php

return [

    'single' => [

        'label' => 'ลบข้อมูลถาวร :label', // Using "ลบข้อมูลถาวร" (lop datao thao wan) for "force delete" to emphasize permanence

        'modal' => [

            'heading' => 'ลบข้อมูลถาวร :label',

            'actions' => [

                'delete' => [
                    'label' => 'ลบข้อมูล', // Using "ลบข้อมูล" (lop datao) for "delete" to maintain consistency
                ],

            ],

        ],

        'notifications' => [

            'deleted' => [
                'title' => 'ข้อมูลถูกลบถาวร', // Using "ข้อมูลถูกลบถาวร" (datao took lop thao wan) for "deleted" to clarify permanence
            ],

        ],

    ],

    'multiple' => [

        'label' => 'ลบข้อมูลถาวรรายการที่เลือก :label',

        'modal' => [

            'heading' => 'ลบข้อมูลถาวรรายการที่เลือก :label',

            'actions' => [

                'delete' => [
                    'label' => 'ลบข้อมูล',
                ],

            ],

        ],

        'notifications' => [

            'deleted' => [
                'title' => 'ข้อมูลถูกลบถาวร',
            ],

        ],

    ],

];
