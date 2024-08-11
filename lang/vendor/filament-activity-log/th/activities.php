<?php

return [
    'title' => 'ประวัติกิจกรรม',

    'date_format' => 'j F Y', // วันที่ เดือน ปี
    'time_format' => 'H:i l',   // ชั่วโมง:นาที ช่วงเวลา (เช้า สาย บ่าย เย็น)

    'filters' => [
        'date' => 'วันที่',
        'causer' => 'ผู้ดำเนินการ',
        'subject_type' => 'หัวข้อ',
        'subject_id' => 'รหัสหัวข้อ',
        'event' => 'กิจกรรม',
    ],
    'table' => [
        'field' => 'ฟิลด์',
        'old' => 'เดิม',
        'new' => 'ใหม่',
        'value' => 'ค่า',
        'no_records_yet' => 'ยังไม่มีรายการ',
    ],
    'events' => [
        'created' => [
            'title' => 'สร้าง',
            'description' => 'สร้างรายการ',
        ],
        'updated' => [
            'title' => 'ปรับปรุง',
            'description' => 'ปรับปรุงรายการ',
        ],
        'deleted' => [
            'title' => 'ลบ',
            'description' => 'ลบรายการ',
        ],
        'restored' => [
            'title' => 'กู้คืน',
            'description' => 'กู้คืนรายการ',
        ],
        'attached' => [
            'title' => 'แนบ',
            'description' => 'แนบไฟล์',
        ],
        'detached' => [
            'title' => 'ปลด',
            'description' => 'ปลดไฟล์',
        ],
        // Your custom events...
    ],
    'boolean' => [
        'true' => 'จริง',
        'false' => 'เท็จ',
    ],
];
