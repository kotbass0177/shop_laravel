<?php

return [

    'column_toggle' => [

        'heading' => 'คอลัมน์',

    ],

    'columns' => [

        'text' => [

            'actions' => [
                'collapse_list' => 'แสดงน้อยลง :count รายการ',
                'expand_list' => 'แสดงเพิ่มเติม :count รายการ',
            ],

            'more_list_items' => 'และอีก :count รายการ',

        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'เลือก/ยกเลิกเลือกทั้งหมดสำหรับการกระทำหมู่',
        ],

        'bulk_select_record' => [
            'label' => 'เลือก/ยกเลิกเลือก รายการ :key สำหรับการกระทำหมู่',
        ],

        'bulk_select_group' => [
            'label' => 'เลือก/ยกเลิกเลือก กลุ่ม :title สำหรับการกระทำหมู่',
        ],

        'search' => [
            'label' => 'ค้นหา',
            'placeholder' => 'ค้นหา',
            'indicator' => 'ค้นหา',
        ],

    ],

    'summary' => [

        'heading' => 'สรุป',

        'subheadings' => [
            'all' => 'ทั้งหมด :label',
            'group' => 'สรุป :group',
            'page' => 'หน้าปัจจุบัน',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'ค่าเฉลี่ย',
            ],

            'count' => [
                'label' => 'จำนวน',
            ],

            'sum' => [
                'label' => 'ผลรวม',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'เสร็จสิ้นการเรียงลำดับ',
        ],

        'enable_reordering' => [
            'label' => 'เรียงลำดับ',
        ],

        'filter' => [
            'label' => 'ตัวกรอง',
        ],

        'group' => [
            'label' => 'กลุ่ม',
        ],

        'open_bulk_actions' => [
            'label' => 'จัดการรายการที่เลือก',
        ],

        'toggle_columns' => [
            'label' => 'แสดง/ซ่อน คอลัมน์',
        ],

    ],

    'empty' => [

        'heading' => 'ไม่มี :model',

        'description' => 'สร้าง :model เพื่อเริ่มต้น',

    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => 'ใช้ตัวกรอง',
            ],

            'remove' => [
                'label' => 'ลบตัวกรอง',
            ],

            'remove_all' => [
                'label' => 'ลบตัวกรองทั้งหมด',
                'tooltip' => 'ลบตัวกรองทั้งหมด',
            ],

            'reset' => [
                'label' => 'รีเซ็ต',
            ],

        ],

        'heading' => 'ตัวกรอง',

        'indicator' => 'ตัวกรองที่ใช้งานอยู่',

        'multi_select' => [
            'placeholder' => 'ทั้งหมด',
        ],

        'select' => [
            'placeholder' => 'ทั้งหมด',
        ],

        'trashed' => [

            'label' => 'รายการที่ถูกลบ',

            'only_trashed' => 'เฉพาะรายการที่ถูกลบ',

            'with_trashed' => 'รวมรายการที่ถูกลบ',

            'without_trashed' => 'ไม่รวมรายการที่ถูกลบ',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'กลุ่มตาม',
                'placeholder' => 'กลุ่มตาม',
            ],

            'direction' => [

                'label' => 'เรียงกลุ่ม',

                'options' => [
                    'asc' => 'น้อยไปมาก',
                    'desc' => 'มากไปน้อย',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'ลากและวางเรียงลำดับรายการ',

    'selection_indicator' => [

        'selected_count' => 'เลือก 1 รายการ|:count รายการ',

        'actions' => [

            'select_all' => [
                'label' => 'เลือกทั้งหมด :count',
            ],

            'deselect_all' => [
                'label' => 'ยกเลิกการเลือกทั้งหมด',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'เรียงตาม',
            ],

            'direction' => [

                'label' => 'ทิศทางการเรียง',

                'options' => [
                    'asc' => 'น้อยไปมาก',
                    'desc' => 'มากไปน้อย',
                ],

            ],

        ],

    ],

];
