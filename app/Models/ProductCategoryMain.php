<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class ProductCategoryMain extends Model
{
    use HasFactory,SoftDeletes,BlameableTrait;

    public static $attributeLabels = [
        'code' => 'โค้ดประเภทสินค้าหลัก',
        'name' => 'ชื่อประเภทสินค้าหลัก',
        'description' => 'รายละเอียดประเภทสินค้าหลัก',
        'image' => 'รูปประเภทสินค้าหลัก',
        'status' => 'สถานะ',
        'active' => 'สถานะการใช้งาน',
        'remark' => 'หมายเหตุ',
        'created_by' => 'ผู้สร้าง',
        'updated_by' => 'ผู้แก้ไข',
        'deleted_by' => 'ผู้ลบ',
    ];
}
