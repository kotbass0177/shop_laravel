<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Brand extends Model
{
    use HasFactory,SoftDeletes,BlameableTrait;

    public static $attributeLabels = [
        'code' => 'โค้ดแบรนด์',
        'name' => 'ชื่อแบรนด์',
        'description' => 'รายละเอียดแบรนด์',
        'image' => 'รูปภาพแบรนด์',
        'active' => 'สถานะการใช้งาน',
        'created_by' => 'ผู้สร้าง',
        'updated_by' => 'ผู้แก้ไข',
        'deleted_by' => 'ผู้ลบ',
    ];
}
