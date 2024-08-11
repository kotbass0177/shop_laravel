<?php

return [

    'builder' => [
        'actions' => [
            'clone' => [
                'label' => 'โคลน', // Clone
            ],
            'add' => [
                'label' => 'เพิ่มไปที่: {label}', // Add to: {label} (placeholders for dynamic label)
            ],
            'add_between' => [
                'label' => 'แทรกไว้ระหว่างบล็อก', // Insert between blocks
            ],
            'delete' => [
                'label' => 'ลบ', // Delete
            ],
            'reorder' => [
                'label' => 'ย้าย', // Move
            ],
            'move_down' => [
                'label' => 'ย้ายลง', // Move down
            ],
            'move_up' => [
                'label' => 'ย้ายขึ้น', // Move up
            ],
            'collapse' => [
                'label' => 'ยุบ', // Collapse
            ],
            'expand' => [
                'label' => 'ขยาย', // Expand
            ],
            'collapse_all' => [
                'label' => 'ยุบทั้งหมด', // Collapse all
            ],
            'expand_all' => [
                'label' => 'ขยายทั้งหมด', // Expand all
            ],
        ],
    ],
    'checkbox_list' => [
        'actions' => [
            'deselect_all' => [
                'label' => 'ยกเลิกการเลือกทั้งหมด', // Deselect all
            ],
            'select_all' => [
                'label' => 'เลือกทั้งหมด', // Select all
            ],
        ],
    ],

    'file_upload' => [
        'editor' => [
            'actions' => [
                'cancel' => [
                    'label' => 'ยกเลิก', // Cancel
                ],
                'drag_crop' => [
                    'label' => 'โหมดลาก "ครอบตัด"', // Drag mode "crop"
                ],
                'drag_move' => [
                    'label' => 'โหมดลาก "ย้าย"', // Drag mode "move"
                ],
                'flip_horizontal' => [
                    'label' => 'พลิกภาพแนวนอน', // Flip image horizontally
                ],
                'flip_vertical' => [
                    'label' => 'พลิกภาพแนวตั้ง', // Flip image vertically
                ],
                'move_down' => [
                    'label' => 'ย้ายภาพลง', // Move image down
                ],
                'move_left' => [
                    'label' => 'ย้ายภาพไปทางซ้าย', // Move image to left
                ],
                'move_right' => [
                    'label' => 'ย้ายภาพไปทางขวา', // Move image to right
                ],
                'move_up' => [
                    'label' => 'ย้ายภาพขึ้น', // Move image up
                ],
                'reset' => [
                    'label' => 'รีเซ็ต', // Reset
                ],
                'rotate_left' => [
                    'label' => 'หมุนภาพไปทางซ้าย', // Rotate image to left
                ],
                'rotate_right' => [
                    'label' => 'หมุนภาพไปทางขวา', // Rotate image to right
                ],
                'set_aspect_ratio' => [
                    'label' => 'ตั้งอัตราส่วนภาพเป็น :ratio', // Set aspect ratio to :ratio
                ],
                'save' => [
                    'label' => 'บันทึก', // Save
                ],
                'zoom_100' => [
                    'label' => 'ซูมภาพเป็น 100%', // Zoom image to 100%
                ],
                'zoom_in' => [
                    'label' => 'ซูมเข้า', // Zoom in
                ],
                'zoom_out' => [
                    'label' => 'ซูมออก', // Zoom out
                ],
            ],
            'fields' => [
                'height' => [
                    'label' => 'ความสูง', // Height
                    'unit' => 'px',
                ],
                'rotation' => [
                    'label' => 'การหมุน', // Rotation
                    'unit' => 'deg',
                ],
                'width' => [
                    'label' => 'ความกว้าง', // Width
                    'unit' => 'px',
                ],
                'x_position' => [
                    'label' => 'X', // X
                    'unit' => 'px',
                ],
                'y_position' => [
                    'label' => 'Y', // Y
                    'unit' => 'px',
                ],
            ],
            'aspect_ratios' => [
                'label' => 'อัตราส่วนภาพ', // Aspect ratios
                'no_fixed' => [
                    'label' => 'อิสระ', // Free
                ],
            ],
            'svg' => [
                'messages' => [
                    'confirmation' => 'ไม่แนะนำให้แก้ไขไฟล์ SVG เนื่องจากอาจสูญเสียคุณภาพเมื่อปรับขนาด \n คุณแน่ใจหรือไม่ว่าต้องการดำเนินการต่อ?', // Editing SVG files is not recommended as it can result in quality loss when scaling. \n Are you sure you want to continue?
                    'disabled' => 'ไม่สามารถแก้ไขไฟล์ SVG ได้เนื่องจากอาจสูญเสียคุณภาพเมื่อปรับขนาด', // Editing SVG files is disabled as it can result in quality loss when scaling.
                ],
            ],
        ],
    ],

    'key_value' => [

        'actions' => [

            'add' => [
                'label' => 'เพิ่มแถว', // Add row
            ],

            'delete' => [
                'label' => 'ลบแถว', // Delete row
            ],

            'reorder' => [
                'label' => 'เรียงลำดับแถว', // Reorder row
            ],

        ],

        'fields' => [

            'key' => [
                'label' => 'คีย์', // Key
            ],

            'value' => [
                'label' => 'ค่า', // Value
            ],

        ],

    ],

    'markdown_editor' => [

        'toolbar_buttons' => [

            'attach_files' => 'แนบไฟล์', // Attach files
            'blockquote' => 'คำคม', // Blockquote
            'bold' => 'ตัวหนา', // Bold
            'bullet_list' => 'รายการแบบหัวข้อ', // Bullet list
            'code_block' => 'บล็อกโค้ด', // Code block
            'heading' => 'หัวข้อ', // Heading
            'italic' => 'ตัวเอียง', // Italic
            'link' => 'ลิงก์', // Link
            'ordered_list' => 'รายการแบบตัวเลข', // Numbered list
            'redo' => 'ทำซ้ำ', // Redo
            'strike' => 'ขีดทับ', // Strikethrough
            'table' => 'ตาราง', // Table
            'undo' => 'ย้อนกลับ', // Undo

        ],

    ],

    'radio' => [

        'boolean' => [

            'true' => 'ใช่', // Yes
            'false' => 'ไม่ใช่', // No

        ],

    ],

    'repeater' => [

        'actions' => [

            'add' => [
                'label' => 'เพิ่มไปที่ :label', // Add to :label (placeholders for dynamic label)
            ],

            'add_between' => [
                'label' => 'แทรกไว้ระหว่าง', // Insert between
            ],

            'delete' => [
                'label' => 'ลบ', // Delete
            ],

            'clone' => [
                'label' => 'โคลน', // Clone
            ],

            'reorder' => [
                'label' => 'ย้าย', // Move
            ],

            'move_down' => [
                'label' => 'ย้ายลง', // Move down
            ],

            'move_up' => [
                'label' => 'ย้ายขึ้น', // Move up
            ],

            'collapse' => [
                'label' => 'ยุบ', // Collapse
            ],

            'expand' => [
                'label' => 'ขยาย', // Expand
            ],

            'collapse_all' => [
                'label' => 'ยุบทั้งหมด', // Collapse all
            ],

            'expand_all' => [
                'label' => 'ขยายทั้งหมด', // Expand all
            ],

        ],

    ],

    'rich_editor' => [

        'dialogs' => [

            'link' => [

                'actions' => [
                    'link' => 'ลิงก์', // Link
                    'unlink' => 'ยกเลิกการลิงก์', // Unlink
                ],

                'label' => 'URL',

                'placeholder' => 'ป้อน URL', // Enter a URL

            ],

        ],

        'toolbar_buttons' => [

            'attach_files' => 'แนบไฟล์', // Attach files
            'blockquote' => 'คำคม', // Blockquote
            'bold' => 'ตัวหนา', // Bold
            'bullet_list' => 'รายการแบบหัวข้อ', // Bullet list
            'code_block' => 'บล็อกโค้ด', // Code block
            'h1' => 'หัวข้อหลัก', // Title
            'h2' => 'หัวข้อย่อย', // Heading
            'h3' => 'หัวข้อย่อยย่อย', // Subheading
            'italic' => 'ตัวเอียง', // Italic
            'link' => 'ลิงก์', // Link
            'ordered_list' => 'รายการแบบตัวเลข', // Numbered list
            'redo' => 'ทำซ้ำ', // Redo
            'strike' => 'ขีดทับ', // Strikethrough
            'underline' => 'ขีดเส้นใต้', // Underline
            'undo' => 'ย้อนกลับ', // Undo

        ],

    ],


    'select' => [

        'actions' => [

            'create_option' => [

                'modal' => [

                    'heading' => 'สร้าง', // Create
                    'actions' => [

                        'create' => [
                            'label' => 'สร้าง', // Create
                        ],

                        'create_another' => [
                            'label' => 'สร้าง และสร้างอีก', // Create & create another
                        ],

                    ],

                ],

            ],

            'edit_option' => [

                'modal' => [

                    'heading' => 'แก้ไข', // Edit
                    'actions' => [

                        'save' => [
                            'label' => 'บันทึก', // Save
                        ],

                    ],

                ],

            ],

        ],

        'boolean' => [
            'true' => 'ใช่', // Yes
            'false' => 'ไม่ใช่', // No
        ],

        'loading_message' => 'กำลังโหลด...', // Loading...
        'max_items_message' => 'สามารถเลือกได้เพียง :count รายการเท่านั้น', // Only :count can be selected.
        'no_search_results_message' => 'ไม่พบตัวเลือกที่ตรงกับการค้นหาของคุณ', // No options match your search.
        'placeholder' => 'เลือกตัวเลือก', // Select an option
        'searching_message' => 'กำลังค้นหา...', // Searching...
        'search_prompt' => 'เริ่มพิมพ์เพื่อค้นหา...', // Start typing to search...

    ],

    'tags_input' => [
        'placeholder' => 'แท็กใหม่', // New tag
    ],

    'text_input' => [

        'actions' => [

            'hide_password' => [
                'label' => 'ซ่อนรหัสผ่าน', // Hide password
            ],

            'show_password' => [
                'label' => 'แสดงรหัสผ่าน', // Show password
            ],

        ],

    ],

    'toggle_buttons' => [

        'boolean' => [
            'true' => 'ใช่', // Yes
            'false' => 'ไม่ใช่', // No
        ],

    ],

    'wizard' => [

        'actions' => [

            'previous_step' => [
                'label' => 'ย้อนกลับ', // Back
            ],

            'next_step' => [
                'label' => 'ถัดไป', // Next
            ],

        ],

    ],

];
