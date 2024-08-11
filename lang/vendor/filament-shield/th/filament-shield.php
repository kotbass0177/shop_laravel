<?php

return [
    /*
  |--------------------------------------------------------------------------
  | Table Columns
  |--------------------------------------------------------------------------
  */

    'column.name' => 'ชื่อ', // Name (translated to Thai)
    'column.guard_name' => 'ชื่อ Guard', // Guard Name (translated to Thai)
    'column.roles' => 'บทบาท', // Roles (translated to Thai)
    'column.permissions' => 'สิทธิ์การใช้งาน', // Permissions (translated to Thai)
    'column.updated_at' => 'อัปเดตเมื่อ', // Updated At (translated to Thai)

    /*
  |--------------------------------------------------------------------------
  | Form Fields
  |--------------------------------------------------------------------------
  */

    'field.name' => 'ชื่อ', // Name (translated to Thai)
    'field.guard_name' => 'ชื่อ Guard', // Guard Name (translated to Thai)
    'field.permissions' => 'สิทธิ์การใช้งาน', // Permissions (translated to Thai)
    'field.select_all.name' => 'เลือกทั้งหมด', // Select All (translated to Thai)
    'field.select_all.message' => 'เปิดใช้งานสิทธิ์ทั้งหมด <span class="text-primary font-medium">ที่มีอยู่</span> สำหรับหน้าที่ในระบบนี้', // Enable all Permissions currently <span class="text-primary font-medium">Enabled</span> for this role (translated to Thai)

    /*
  |--------------------------------------------------------------------------
  | Navigation & Resource
  |--------------------------------------------------------------------------
  */

    'nav.group' => 'จัดการสิทธิ์ผู้ใช้งาน', // Manage Permissions (translated to Thai)
    'nav.role.label' => 'หน้าที่ในระบบ', // Roles (translated to Thai)
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'หน้าที่ในระบบ', // Role (translated to Thai)
    'resource.label.roles' => 'หน้าที่ในระบบ', // Roles (translated to Thai)

  /*
  |--------------------------------------------------------------------------
  | Section & Tabs
  |--------------------------------------------------------------------------
  */

  'section' => 'หมวดหมู่', // Category or Section
  'resources' => 'ทรัพยากร', // Resources
  'widgets' => 'วิดเจ็ต', // Widgets
  'pages' => 'หน้าจอ', // Page
  'custom' => 'สิทธิ์การใช้งานแบบกำหนดเอง', // Custom permissions
  
    /*
  |--------------------------------------------------------------------------
  | Messages
  |--------------------------------------------------------------------------
  */

    'forbidden' => 'คุณไม่มีสิทธิ์ในการเข้าถึง', // You do not have permission to access this. (translated to Thai)

    /*
  |--------------------------------------------------------------------------
  | Resource Permissions' Labels
  |--------------------------------------------------------------------------
  */

    'resource_permission_prefixes_labels' => [
        'view' => 'แสดงข้อมูลรายการ', // View List (translated to Thai)
        'view_any' => 'แสดงตารางข้อมูล', // View Table (translated to Thai)
        'create' => 'สร้างรายการ', // Create (translated to Thai)
        'update' => 'แก้ไขรายการ', // Update (translated to Thai)
        'delete' => 'ลบรายการ', // Delete (translated to Thai)
        'delete_any' => 'ลบหลายรายการ', // Delete Multiple (translated to Thai)
        'force_delete' => 'ลบถาวร',
        'force_delete_any' => 'ลบถาวรหลายรายการ',
        'restore' => 'กู้คืนรายการ', // Restore (translated to Thai)
        'reorder' => 'เรียงลำดับ', // Reorder (translated to Thai)
        'restore_any' => 'กู้คืนหลายรายการ', // Restore Multiple (translated to Thai)
        'replicate' => 'คัดลอกข้อมูลรายการ', // Replicate (translated to Thai)
        'export' => 'ส่งออก',
    ],
];
