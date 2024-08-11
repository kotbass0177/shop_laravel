<?php

return [

    'label' => 'ส่งออก :label', // Using "ส่งออก" (sòng auk) for "export" as it's commonly used in this context

    'modal' => [

        'heading' => 'ส่งออก :label',

        'form' => [

            'columns' => [

                'label' => 'คอลัมน์', // Using "คอลัมน์" (khan lom) for "columns"

                'form' => [

                    'is_enabled' => [
                        'label' => ':column เปิดใช้งาน', // Using "เปิดใช้งาน" (bphed jak dtai) for "enabled"
                    ],

                    'label' => [
                        'label' => ':column ชื่อ', // Using "ชื่อ" (chee wit) for "label"
                    ],

                ],

            ],

        ],

        'actions' => [

            'export' => [
                'label' => 'ส่งออก',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'ส่งออกเสร็จสมบูรณ์', // Using "เสร็จสมบูรณ์" (sàt som boon) for "completed"

            'actions' => [

                'download_csv' => [
                    'label' => 'ดาวน์โหลด .csv', // Using "ดาวน์โหลด" (dao wn loht) for "download"
                ],

                'download_xlsx' => [
                    'label' => 'ดาวน์โหลด .xlsx',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'ไฟล์ส่งออกมีขนาดใหญ่เกินไป', // Using "ไฟล์" (fai) for "file"
            'body' => 'คุณส่งออกได้ไม่เกิน 1 รายการในครั้งเดียว|คุณส่งออกได้ไม่เกิน :count รายการในครั้งเดียว', // Using "รายการ" (rai ngan) for "row"
        ],

        'started' => [
            'title' => 'เริ่มส่งออก',
            'body' => 'การส่งออกของคุณเริ่มต้นขึ้นแล้ว และ 1 รายการจะถูกประมวลผลเบื้องหลัง|การส่งออกของคุณเริ่มต้นขึ้นแล้ว และ :count รายการจะถูกประมวลผลเบื้องหลัง',
        ],

    ],

    'file_name' => 'export-:export_id-:model', // File name format remains the same

];
