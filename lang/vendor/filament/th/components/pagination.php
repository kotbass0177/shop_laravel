<?php

return [

    'label' => 'การนำทางแบบแบ่งหน้า',

    'overview' => '{1} แสดงผลลัพธ์ 1 รายการ|[2,*] แสดงผลลัพธ์ :first ถึง :last จากทั้งหมด :total รายการ',

    'fields' => [

        'records_per_page' => [

            'label' => 'ต่อหน้า',

            'options' => [
                'all' => 'ทั้งหมด',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'แรก',
        ],

        'go_to_page' => [
            'label' => 'ไปที่หน้า :page',
        ],

        'last' => [
            'label' => 'สุดท้าย',
        ],

        'next' => [
            'label' => 'ถัดไป',
        ],

        'previous' => [
            'label' => 'ก่อนหน้า',
        ],

    ],

];
