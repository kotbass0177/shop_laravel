<?php

return [

    'label' => 'ตัวสร้างเงื่อนไข', // Keep 'Query builder' in Thai

    'form' => [
        'operator' => [
            'label' => 'ตัวดำเนินการ', // Keep 'Operator' in Thai
        ],

        'or_groups' => [
            'label' => 'กลุ่ม (OR)',  // Keep 'Groups (OR)' in Thai
            'block' => [
                'label' => 'หรือ (OR)',  // Keep 'OR' in Thai
                'or' => 'OR',
            ],
        ],

        'rules' => [
            'label' => 'กฎ',  // Keep 'Rules' in Thai
            'item' => [
                'and' => 'AND',
            ],
        ],
    ],

    'no_rules' => '(ไม่มีกฎ)',  // Keep '(No Rules)' in Thai

    'item_separators' => [
        'and' => 'AND',
        'or' => 'OR',
    ],

    'operators' => [

        'is_filled' => [

            'label' => [
                'direct' => 'มีข้อมูล',
                'inverse' => 'ว่างเปล่า',
            ],

            'summary' => [
                'direct' => ':attribute มีข้อมูล',
                'inverse' => ':attribute ว่างเปล่า',
            ],

        ],

        'boolean' => [

            'is_true' => [

                'label' => [
                    'direct' => 'เป็นจริง',
                    'inverse' => 'เป็นเท็จ',
                ],

                'summary' => [
                    'direct' => ':attribute เป็นจริง',
                    'inverse' => ':attribute เป็นเท็จ',
                ],

            ],

        ],

        'date' => [

            'is_after' => [

                'label' => [
                    'direct' => 'หลังจาก',
                    'inverse' => 'ไม่หลังจาก',
                ],

                'summary' => [
                    'direct' => ':attribute หลังจาก :date',
                    'inverse' => ':attribute ไม่หลังจาก :date',
                ],

            ],

            'is_before' => [

                'label' => [
                    'direct' => 'ก่อน',
                    'inverse' => 'ไม่ก่อน',
                ],

                'summary' => [
                    'direct' => ':attribute ก่อน :date',
                    'inverse' => ':attribute ไม่ก่อน :date',
                ],

            ],

            'is_date' => [

                'label' => [
                    'direct' => 'เป็นวันที่',
                    'inverse' => 'ไม่เป็นวันที่',
                ],

                'summary' => [
                    'direct' => ':attribute เป็นวันที่ :date',
                    'inverse' => ':attribute ไม่เป็นวันที่ :date',
                ],

            ],

            'is_month' => [

                'label' => [
                    'direct' => 'เป็นเดือน',
                    'inverse' => 'ไม่เป็นเดือน',
                ],

                'summary' => [
                    'direct' => ':attribute เป็นเดือน :month',
                    'inverse' => ':attribute ไม่เป็นเดือน :month',
                ],

            ],

            'is_year' => [

                'label' => [
                    'direct' => 'เป็นปี',
                    'inverse' => 'ไม่เป็นปี',
                ],

                'summary' => [
                    'direct' => ':attribute เป็นปี :year',
                    'inverse' => ':attribute ไม่เป็นปี :year',
                ],

            ],

            'form' => [

                'date' => [
                    'label' => 'วันที่',
                ],

                'month' => [
                    'label' => 'เดือน',
                ],

                'year' => [
                    'label' => 'ปี',
                ],

            ],

        ],

        'number' => [

            'equals' => [

                'label' => [
                    'direct' => 'เท่ากับ',
                    'inverse' => 'ไม่เท่ากับ',
                ],

                'summary' => [
                    'direct' => ':attribute เท่ากับ :number',
                    'inverse' => ':attribute ไม่เท่ากับ :number',
                ],

            ],

            'is_max' => [

                'label' => [
                    'direct' => 'เป็นค่าสูงสุด',
                    'inverse' => 'มากกว่า',
                ],

                'summary' => [
                    'direct' => ':attribute เป็นค่าสูงสุด :number',
                    'inverse' => ':attribute มากกว่า :number',
                ],

            ],

            'is_min' => [

                'label' => [
                    'direct' => 'เป็นค่าต่ำสุด',
                    'inverse' => 'น้อยกว่า',
                ],

                'summary' => [
                    'direct' => ':attribute เป็นค่าต่ำสุด :number',
                    'inverse' => ':attribute น้อยกว่า :number',
                ],

            ],

            'aggregates' => [

                'average' => [
                    'label' => 'ค่าเฉลี่ย',
                    'summary' => 'ค่าเฉลี่ยของ :attribute',
                ],

                'max' => [
                    'label' => 'สูงสุด',
                    'summary' => 'ค่าสูงสุดของ :attribute',
                ],

                'min' => [
                    'label' => 'ต่ำสุด',
                    'summary' => 'ค่าต่ำสุดของ :attribute',
                ],

                'sum' => [
                    'label' => 'ผลรวม',
                    'summary' => 'ผลรวมของ :attribute',
                ],

            ],

            'form' => [

                'aggregate' => [
                    'label' => 'ฟังก์ชันการรวม',
                ],

                'number' => [
                    'label' => 'ตัวเลข',
                ],

            ],

        ],

        'relationship' => [

            'equals' => [

                'label' => [
                    'direct' => 'มี',
                    'inverse' => 'ไม่มี',
                ],

                'summary' => [
                    'direct' => 'มี :count :relationship',
                    'inverse' => 'ไม่มี :count :relationship',
                ],

            ],

            'has_max' => [

                'label' => [
                    'direct' => 'มีค่าสูงสุด',
                    'inverse' => 'มีมากกว่า',
                ],

                'summary' => [
                    'direct' => 'มีค่าสูงสุด :count :relationship',
                    'inverse' => 'มีมากกว่า :count :relationship',
                ],

            ],

            'has_min' => [

                'label' => [
                    'direct' => 'มีค่าน้อยสุด',
                    'inverse' => 'มีน้อยกว่า',
                ],

                'summary' => [
                    'direct' => 'มีค่าน้อยสุด :count :relationship',
                    'inverse' => 'มีน้อยกว่า :count :relationship',
                ],

            ],

            'is_empty' => [

                'label' => [
                    'direct' => 'ว่างเปล่า',
                    'inverse' => 'ไม่ว่างเปล่า',
                ],

                'summary' => [
                    'direct' => ':relationship ว่างเปล่า',
                    'inverse' => ':relationship ไม่ว่างเปล่า',
                ],

            ],

            'is_related_to' => [

                'label' => [

                    'single' => [
                        'direct' => 'เป็น',
                        'inverse' => 'ไม่เป็น',
                    ],

                    'multiple' => [
                        'direct' => 'ประกอบด้วย',
                        'inverse' => 'ไม่ประกอบด้วย',
                    ],

                ],

                'summary' => [

                    'single' => [
                        'direct' => ':relationship เป็น :values',
                        'inverse' => ':relationship ไม่เป็น :values',
                    ],

                    'multiple' => [
                        'direct' => ':relationship ประกอบด้วย :values',
                        'inverse' => ':relationship ไม่ประกอบด้วย :values',
                    ],

                    'values_glue' => [
                        0 => ', ',
                        'final' => ' หรือ ',
                    ],

                ],

            ],

            'form' => [

                'value' => [
                    'label' => 'ค่า',
                ],

                'values' => [
                    'label' => 'ค่าต่างๆ',
                ],

            ],

        ],

        'form' => [

            'count' => [
                'label' => 'จำนวน',
            ],

        ],

        'select' => [

            'is' => [

                'label' => [
                    'direct' => 'เป็น',
                    'inverse' => 'ไม่เป็น',
                ],

                'summary' => [
                    'direct' => ':attribute เป็น :values',
                    'inverse' => ':attribute ไม่เป็น :values',
                    'values_glue' => [
                        0 => ', ',
                        'final' => ' หรือ ',
                    ],
                ],

                'form' => [

                    'value' => [
                        'label' => 'ค่า',
                    ],

                    'values' => [
                        'label' => 'ค่าต่างๆ',
                    ],

                ],

            ],

        ],

        'text' => [

            'contains' => [

                'label' => [
                    'direct' => 'ประกอบด้วย',
                    'inverse' => 'ไม่ประกอบด้วย',
                ],

                'summary' => [
                    'direct' => ':attribute ประกอบด้วย :text',
                    'inverse' => ':attribute ไม่ประกอบด้วย :text',
                ],

            ],

            'ends_with' => [

                'label' => [
                    'direct' => 'ลงท้ายด้วย',
                    'inverse' => 'ไม่ลงท้ายด้วย',
                ],

                'summary' => [
                    'direct' => ':attribute ลงท้ายด้วย :text',
                    'inverse' => ':attribute ไม่ลงท้ายด้วย :text',
                ],

            ],

            'equals' => [

                'label' => [
                    'direct' => 'เท่ากับ',
                    'inverse' => 'ไม่เท่ากับ',
                ],

                'summary' => [
                    'direct' => ':attribute เท่ากับ :text',
                    'inverse' => ':attribute ไม่เท่ากับ :text',
                ],

            ],

            'starts_with' => [

                'label' => [
                    'direct' => 'ขึ้นต้นด้วย',
                    'inverse' => 'ไม่ขึ้นต้นด้วย',
                ],

                'summary' => [
                    'direct' => ':attribute ขึ้นต้นด้วย :text',
                    'inverse' => ':attribute ไม่ขึ้นต้นด้วย :text',
                ],

            ],

            'form' => [

                'text' => [
                    'label' => 'ข้อความ',
                ],

            ],
        ],
    ],

    'actions' => [

        'add_rule' => [
            'label' => 'เพิ่มเงื่อนไข',
        ],

        'add_rule_group' => [
            'label' => 'เพิ่มกลุ่มเงื่อนไข',
        ],

    ],

];
