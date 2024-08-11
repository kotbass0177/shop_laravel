<?php

return [

    'label' => 'นำเข้า :label', // Using "นำเข้า" (nahm khao) for "import"

    'modal' => [

        'heading' => 'นำเข้า :label',

        'form' => [

            'file' => [
                'label' => 'ไฟล์', // Using "ไฟล์" (fai) for "file"
                'placeholder' => 'อัปโหลดไฟล์ CSV', // Using "อัปโหลด" (ap lot) for "upload"
            ],

            'columns' => [
                'label' => 'คอลัมน์', // Using "คอลัมน์" (khan lom) for "columns"
                'placeholder' => 'เลือกคอลัมน์', // Using "เลือก" (leuag) for "select"
            ],

        ],

        'actions' => [

            'download_example' => [
                'label' => 'ดาวน์โหลดไฟล์ CSV ตัวอย่าง', // Using "ดาวน์โหลด" (dao wn loht) for "download"
            ],

            'import' => [
                'label' => 'นำเข้า',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'การนำเข้าเสร็จสมบูรณ์', // Using "เสร็จสมบูรณ์" (sàt som boon) for "completed"

            'actions' => [

                'download_failed_rows_csv' => [
                    'label' => 'ดาวน์โหลดข้อมูลแถวที่นำเข้าไม่สำเร็จ|ดาวน์โหลดข้อมูลแถวที่นำเข้าไม่สำเร็จ (หลายแถว)', // Using "แถว" (tae) for "row" and considering singular/plural cases
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'ไฟล์ CSV ที่อัปโหลดมีขนาดใหญ่เกินไป',
            'body' => 'คุณนำเข้าได้ไม่เกิน 1 แถวในครั้งเดียว|คุณนำเข้าได้ไม่เกิน :count แถวในครั้งเดียว',
        ],

        'started' => [
            'title' => 'เริ่มนำเข้า',
            'body' => 'การนำเข้าของคุณเริ่มต้นขึ้นแล้ว และ 1 แถวจะถูกประมวลผลเบื้องหลัง|การนำเข้าของคุณเริ่มต้นขึ้นแล้ว และ :count แถวจะถูกประมวลผลเบื้องหลัง',
        ],

    ],

    'example_csv' => [
        'file_name' => ':importer-example',
    ],

    'failure_csv' => [
        'file_name' => 'import-:import_id-:csv_name-failed-rows',
        'error_header' => 'ข้อผิดพลาด', // Using "ข้อผิดพลาด" (khao phit phlat) for "error"
        'system_error' => 'ข้อผิดพลาดของระบบ กรุณาติดต่อฝ่ายสนับสนุน', // Using "ฝ่ายสนับสนุน" (fai sanap dtoon) for "support"
    ],

];
